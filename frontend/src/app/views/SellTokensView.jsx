import React, { useEffect, useState } from 'react';
import { Formik, Form } from 'formik';
import { useDispatch, useSelector } from 'react-redux';
import { useNavigate, NavLink } from 'react-router-dom';
import axios from 'axios';
import { signIn } from '../redux-store/authenticationSlice';
import Button from '../components/FormComponents/Button';
import Input from '../components/FormComponents/Input';
import Select from '../components/FormComponents/Select';
import { URL_BACK } from '../constants/urls/urlBackEnd';
import { current } from '@reduxjs/toolkit';
import { BsFillPencilFill, BsFillTrashFill } from 'react-icons/bs';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import CustomToast from '../components/toast/CustomToast';

function BuyTokens() {
  const vendeur = useSelector((state) => state.user);
  const [nbTokens, setNbTokens] = useState(0);
  const navigate = useNavigate();
  const [annonces, setAnnonces] = useState([]);

  /////Fetch les annonces de l'utilisateur en cours/////
  useEffect(() => {
    axios
      .get(URL_BACK + `/get/annonces_by_user_id/` + vendeur.id)
      .then((res) => setAnnonces(res.data));
  }, [vendeur]);

  /////Affiche les annonces fetchées précedemment/////
  function annoncesDisplayer() {
    return annonces.map((annonces) => (
      <tr>
        <td className="border border-slate-300 px-8 py-2 text-center text-Whitesmoke">
          {annonces.date ? annonces.date : null}
        </td>
        <td className="border border-slate-300 px-8 py-2 text-center text-Whitesmoke">
          {annonces.nb_tokens ? annonces.nb_tokens : null}
        </td>
        <td className="border border-slate-300 px-8 py-2 text-center text-Whitesmoke">
          {annonces.montant ? annonces.montant + ' €' : null}
        </td>
        <td className="border border-slate-300 px-8 py-2 text-center text-Whitesmoke">
          {annonces.statut ? annonces.statut : null}
        </td>
        <td className="border border-slate-300 px-8 py-2 text-center text-Whitesmoke ">
          <BsFillTrashFill
            className="cursor-pointer mx-auto"
            onClick={() => deleteAnnonces(annonces.id)}
          />
        </td>
      </tr>
    ));
  }

  function deleteAnnonces(id) {
    axios.delete(URL_BACK + `/api/annonces/${id}`);
  }

  return (
    <div className="flex flex-col h-[84vh] bg-Teal items-center ">
      <div className="title mt-8">
        <h1 className="text-Whitesmoke font-bold mb-4">Vente de tokens</h1>
      </div>
      <div className="box-border border-8 w-9/12 h-4/6 bg-Moonstone text-center justify-center rounded-lg">
        <h5 className="text-Whitesmoke font-bold text-center mt-4 mb-16">
          Solde de tokens : {vendeur.tokens}
        </h5>
        <div className="flex justify-around items-center h-4/6 px-4">
          <div className="bg-Teal flex justify-around rounded-xl w-5/12 items-center px-4">
            <div className="w-full">
              <Formik
                initialValues={{
                  nbTokens: 0,
                }}
                onSubmit={(values) => {
                  console.log('toto');
                  let annonce = {
                    date: new Date().toLocaleDateString().replaceAll('/', '-'),
                    nbTokens: Number(nbTokens),
                    montant: nbTokens / 10,
                    vendeur: '/api/users/' + vendeur.id,
                    statut: 'En cours',
                  };
                  axios
                    .post(URL_BACK + '/api/annonces', annonce)
                    .then((res) => {
                      if (res.status === 201 && res.data) {
                        toast.success(
                          <CustomToast message="Votre annonce a été postée !" />,
                          {
                            position: toast.POSITION.BOTTOM_RIGHT,
                          }
                        );
                        axios
                          .get(
                            URL_BACK + `/get/annonces_by_user_id/` + vendeur.id
                          )
                          .then((res) => setAnnonces(res.data));
                      }
                    });
                }}
              >
                <Form className="w-full max-w-full">
                  <h5 className="text-Whitesmoke font-bold text-center my-8">
                    Poster une annonce
                  </h5>
                  <div className="test flex flex-col justify-center items-center">
                    <div className="flex items-center w-full mb-6">
                      <div className="w-1/3">
                        <label className="block text-[#FFFFFF] font-bold text-left mb-1 pr-4">
                          Nombre de tokens :
                        </label>
                      </div>
                      <div className="w-2/3">
                        <select
                          className="bg-gray-200 appearance-none border-2 border-gray-200 rounded-full w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-[#7cc474] border-transparent focus:ring-0"
                          id="inline-full-name"
                          autoComplete="off"
                          name="nbTokens"
                          onChange={(e) => setNbTokens(e.target.value)}
                        >
                          <option
                            className="text-black font-bold text-lg"
                            value={0}
                          ></option>
                          <option
                            className="text-black font-bold text-lg"
                            value={10}
                          >
                            10
                          </option>
                          <option
                            className="text-black font-bold text-lg"
                            value={50}
                          >
                            50
                          </option>
                          <option
                            className="text-black font-bold text-lg"
                            value={100}
                          >
                            100
                          </option>
                          <option
                            className="text-black font-bold text-lg"
                            value={200}
                          >
                            200
                          </option>
                          <option
                            className="text-black font-bold text-lg"
                            value={300}
                          >
                            300
                          </option>
                          <option
                            className="text-black font-bold text-lg"
                            value={400}
                          >
                            400
                          </option>
                          <option
                            className="text-black font-bold text-lg"
                            value={500}
                          >
                            500
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                </Form>
              </Formik>
            </div>
          </div>
          <div className="bg-Teal flex justify-center items-center max-h-full rounded-xl px-8 py-4">
            <div className="max-h-full overflow-y-auto">
              <h5 className="text-Whitesmoke font-bold text-center mb-4">
                Historique des annonces
              </h5>
              <div className="test flex flex-col justify-center items-center text-Whitesmoke">
                {annonces.length > 0 ? (
                  <table className="table-auto mt-4 mb-4 border-collapse bg-Teal border border-slate-400">
                    <thead>
                      <tr>
                        <th className="border border-slate-300 px-8 py-2 text-Whitesmoke">
                          Date
                        </th>
                        <th className="border border-slate-300 px-8 py-2 text-Whitesmoke">
                          Tokens
                        </th>
                        <th className="border border-slate-300 px-8 py-2 text-Whitesmoke">
                          Montant
                        </th>
                        <th className="border border-slate-300 px-8 py-2 text-Whitesmoke">
                          Statut
                        </th>
                        <th className="border border-slate-300 px-8 py-2 text-Whitesmoke">
                          Actions
                        </th>
                      </tr>
                    </thead>
                    <tbody>{annoncesDisplayer()}</tbody>
                  </table>
                ) : (
                  'Aucune annonce en cours'
                )}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default BuyTokens;
