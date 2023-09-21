import React, { useEffect, useState } from 'react';
import Chat from '../components/chat/Chat';
import { useSelector } from 'react-redux';
import { useNavigate, useParams } from 'react-router-dom';
import axios from 'axios';
import { URL_BACK } from '../constants/urls/urlBackEnd';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faArrowRight } from '@fortawesome/free-solid-svg-icons';
import { Field, Form, Formik } from 'formik';

const VoirprofilView = () => {
  const currentUser = useSelector((state) => state.user);
  const { id } = useParams();
  const navigate = useNavigate();
  const [images, setImages] = useState([]);
  const [message, setMessage] = useState('');
  const [users, setUsers] = useState({});
  const [userTrajets, setUserTrajets] = useState([]);
  const [car, setUserCars] = useState({});
  const [moyenneRating, setMoyenneRating] = useState(0);
  const [showModal, setShowModal] = useState(false);
  const [chatActive, setChatActive] = useState(false);

  useEffect(() => {
    async function fetchUsers() {
      await axios
        .get(URL_BACK + '/api/users/' + id)
        .then((resUsers) => {
          setUsers(resUsers.data);
        })
        .catch((err) => {
          console.log(err);
        });
    }
    fetchUsers();
  }, []);

  useEffect(() => {
    const fetchTrajets = async () => {
      try {
        if (users.id) {
          let somme = 0;
          let count = 0;
          const resultsTrajets = await axios.get(
            URL_BACK + '/get/trajets/' + users.id
          );
          setUserTrajets(resultsTrajets.data);
          document.title = 'Profil de ' + users.nom + ' ' + users.prenom;
          const resultsComments = await axios.get(
            URL_BACK + '/get/comments/' + users.id
          );
          if (resultsComments.data.length > 0) {
            resultsComments.data.forEach((element) => {
              somme = somme + element.rate;
              count++;
            });
            let moyenne = somme / count;
            let decimal = moyenne % 1;

            if (decimal < 0.5) {
              moyenne = moyenne - decimal;
            } else if (decimal >= 0.5) {
              moyenne = moyenne + (1 - decimal);
            } else {
              console.log('error');
            }
            setMoyenneRating(moyenne);
          }
        }
      } catch (error) {
        console.error(error.message);
      }
    };
    fetchTrajets();
  }, [users]);

  let calculateAge = (date) => {
    var formattedDate = date.split('-');
    var birthdateTimeStamp = new Date(
      formattedDate[2],
      formattedDate[1],
      formattedDate[0]
    );
    var currentDate = new Date().getTime();
    var difference = currentDate - birthdateTimeStamp;
    var currentAge = Math.floor(difference / 31557600000);
    return currentAge;
  };

  useEffect(() => {
    const fetchCars = async () => {
      try {
        if (users.id) {
          const UserCars = await axios.get(URL_BACK + '/get/cars/' + users.id);
          setUserCars(UserCars.data);
          console.log(UserCars.data);
          const photosUrlArray = UserCars.data.photosUrl.split(',');
          setImages(photosUrlArray);
        }
      } catch (error) {
        console.error(error.message);
      }
    };
    fetchCars();
  }, [users]);

  useEffect(() => {
    const fetchComments = async () => {
      try {
        if (userTrajets != 0) {
          let somme = 0;
          let count = 0;
          const resultsComments = await axios.post(
            URL_BACK + '/post/comments_by_trajets_id',
            userTrajets
          );
          if (resultsComments.data.length > 0) {
            resultsComments.data.forEach((element) => {
              somme = somme + element.rating;
              count++;
            });
            let moyenne = somme / count;
            let decimal = moyenne % 1;
            if (decimal < 0.5) {
              moyenne = moyenne - decimal;
            } else if (decimal >= 0.5) {
              moyenne = moyenne + (1 - decimal);
            } else {
              console.log('error');
            }
            setMoyenneRating(moyenne);
          }
        }
      } catch (error) {
        console.error(error.message);
      }
    };
    fetchComments();
  }, [userTrajets]);

  return (
    <>
      <div className="flex justify-center items-center h-[84vh] bg-Teal relative">
        {chatActive ? <Chat active={true} userToTalk={users} /> : null}
        <div
          className={`flex justify-center items-center overflow-x-hidden overflow-y-auto fixed backdrop-opacity-20 backdrop-invert bg-white/30 inset-0 z-50 outline-none focus:outline-none${
            showModal ? '' : ' hidden'
          }`}
        >
          <div className="relative w-auto my-6 mx-auto max-w-3xl">
            <div className="border-solid border-4 border-Teal rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
              <div className="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t bg-Teal">
                <h3 className="text-3xl font=semibold text-Whitesmoke">
                  Avis sur{' '}
                  {users.nom && users.prenom
                    ? users.nom + ' ' + users.prenom
                    : ''}
                </h3>
              </div>
              <div className="relative p-6 flex-auto">
                <div className="bg-Teal shadow-md rounded px-8 pt-6 pb-8 w-full">
                  <Formik
                    initialValues={{
                      rating: '1',
                      content: '',
                    }}
                    onSubmit={(values) => {
                      let comment = {
                        rate: Number(values.rating),
                        content: values.content,
                        ratingUserId: '/api/users/' + currentUser.id,
                        ratedUserId: '/api/users/' + id,
                      };
                      axios
                        .post(URL_BACK + '/api/comments', comment)
                        .then((res) => {
                          console.log(res);
                          if (res.status === 201 && res.data) {
                            setShowModal(false);
                          }
                        });
                    }}
                  >
                    <Form className="mt-12 w-full max-w-full">
                      <div className="flex flex-col">
                        <div className="md:w-1/3">
                          <label
                            className="block text-[#FFFFFF] font-bold md:text-left mb-1 md:mb-0 pr-4"
                            htmlFor="passager"
                          >
                            Note :
                          </label>
                        </div>
                        <div className="w-2/12 mb-10">
                          <Field
                            as="select"
                            id="rating"
                            name="rating"
                            className="bg-gray-200 appearance-none border-2 border-gray-200 rounded-full w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-[#7cc474] border-transparent focus:ring-0"
                          >
                            <option key="1" value="1">
                              1
                            </option>
                            <option key="2" value="2">
                              2
                            </option>
                            <option key="3" value="3">
                              3
                            </option>
                            <option key="4" value="4">
                              4
                            </option>
                            <option key="5" value="5">
                              5
                            </option>
                          </Field>
                        </div>
                        <div className="span">
                          <span className="block text-[#FFFFFF] font-bold text-left mb-1 md:mb-0 pr-4">
                            Commentaire (350 caractères max) :
                          </span>
                        </div>
                        <div className="textarea">
                          <Field
                            as="textarea"
                            className="bg-gray-200 appearance-none border-2 border-gray-200 rounded-3xl w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-[#7cc474] border-transparent focus:ring-0"
                            id="content"
                            name="content"
                            rows="4"
                            cols="80"
                            maxLength="350"
                          ></Field>
                        </div>
                      </div>
                      <div className="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b bg-Teal">
                        <button
                          className="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1"
                          type="button"
                          onClick={() => setShowModal(false)}
                        >
                          Annuler
                        </button>
                        <button
                          className="text-white bg-Mantis active:bg-Mantis font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1"
                          type="submit"
                        >
                          Valider
                        </button>
                      </div>
                    </Form>
                  </Formik>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className=" bg-Moonstone h-5/6 w-8/12 py-8 rounded-lg mx-auto my-auto flex justify-around align-center">
          <div className=" h-full bg-Teal py-4 w-[500px] flex flex-col rounded ">
            <p className="mx-auto w-fit text-white text-2xl font-bold">
              {users.prenom} {users.nom}
            </p>
            <div className="flex items-center justify-center mb-12">
              <p className="text-white text-2xl font-bold">
                {users.date_naissance
                  ? calculateAge(users.date_naissance) + ' ans'
                  : null}
              </p>
              <img
                src={users.img_profil}
                className="h-[200px] w-[200px] rounded-full mx-12 my-8"
              />
              <p className="text-white text-2xl font-bold">{users.ville}</p>
            </div>
            <p className="mx-auto w-fit text-white text-2xl font-bold">
              {users.description}
            </p>
          </div>
          <div className="bg-Teal w-[500px] py-4  rounded">
            <div className="flex justify-end bg-[#7cc474] rounded  w-11/12 h-10 items-center mt-2 mx-auto">
              <h1 className="flex text-[30px] mx-auto text-white ">
                Historique des trajets
              </h1>
            </div>
            <div className="flex justify-center w-full mt-8">
              {userTrajets != 0 ? (
                <div>
                  {userTrajets.slice(0, 3).map((trajet) => (
                    <p className="text-white text-lg mb-8">
                      Le {trajet.depart_date.replaceAll('-', '/')} -{' '}
                      {trajet.depart}
                      <FontAwesomeIcon
                        className="FontAwesomeIcon1 ml-4 mr-4"
                        icon={faArrowRight}
                      />
                      {trajet.destination}
                    </p>
                  ))}
                </div>
              ) : (
                <div className={'histor text-justify mt-10 ml-14'}>
                  <p className="text-white mb-8">Aucun trajet</p>
                </div>
              )}
            </div>
            <div className="flex justify-end bg-[#7cc474] rounded  w-11/12 h-10 items-center mt-2 mx-auto">
              <h1 className="flex text-[30px] mx-auto text-white ">
                Avis des utilisateurs
              </h1>
            </div>
            <div className="flex my-10">
              <div className="flex mx-auto my-auto px-12 justify-center items-center ">
                {(() => {
                  const arrUp = [];
                  for (let i = 0; i < Math.floor(moyenneRating); i++) {
                    arrUp.push(
                      <img
                        src="/src/app/assets/img/mdi_leaf-circle.png"
                        className="w-[30px] h-[30px]"
                      />
                    );
                  }
                  return arrUp;
                })()}

                {(() => {
                  const arrDown = [];
                  if (5 - Math.floor(moyenneRating) > 0) {
                    for (let i = 0; i < 5 - Math.floor(moyenneRating); i++) {
                      arrDown.push(
                        <img
                          src="/src/app/assets/img/mdi_leaf-circle_white.png"
                          className="w-[30px] h-[30px]"
                        />
                      );
                    }
                    return arrDown;
                  }
                })()}
              </div>
            </div>
            <div className="flex  justify-between items-center w-11/12 mx-auto mb-8 ">
              <button
                className="items-center text-white drop-shadow-2xl my-auto mx-0 bg-[#7cc474] hover:bg-[#54b44b] font-extrabold py-4 w-[200px] cursor-pointer rounded"
                onClick={() => setShowModal(true)}
              >
                Laisser un avis
              </button>

              <button
                onClick={() => setChatActive(true)}
                className="items-center text-white drop-shadow-2xl my-auto mx-0 bg-[#7cc474] hover:bg-[#54b44b] font-extrabold py-4 w-[200px] cursor-pointer rounded"
              >
                Envoyer un message
              </button>
            </div>
            <div className="w-11/12 flex justify-center mx-auto">
              <button
                className="bg-[#d63939] hover:bg-[#960000] text-white font-extrabold py-4 w-[200px] cursor-pointer rounded mx-auto"
                onClick={() => navigate(`/make/alert/${id}`)}
              >
                Signaler
              </button>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default VoirprofilView;
