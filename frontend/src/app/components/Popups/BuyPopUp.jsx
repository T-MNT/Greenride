import axios from 'axios';
import React from 'react';
import { URL_BACK } from '../../constants/urls/urlBackEnd';
import { useSelector } from 'react-redux';
import InputT from '../InputT';
import { Form, Formik } from 'formik';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faXmark } from '@fortawesome/free-solid-svg-icons';
import * as Yup from 'yup';

const BuyPopUp = (props) => {
  let url = window.location.href;
  let user = useSelector((state) => state.user);

  const validate = Yup.object().shape({
    carte_num: Yup.string()
      .max(16, '*Le numéro ne peut excéder 16 caractères')
      .matches(
        /^\d+$/,
        '*Le numéro de carte ne peut comporter que des chiffres'
      )
      .required('*Ce champ ne peut être vide'),
    carte_crypto: Yup.string()
      .max(3)
      .matches(/^\d+$/, '*Le cryptogramme est invalide !')
      .required('*Ce champ ne peut être vide'),
  });

  ////Ajoute les tokens achetés à l'acheteur et enlève les tokens au vendeur (fonction dans le controller)////
  const buyHandler = () => {
    let date = new Date().toLocaleDateString().replaceAll('/', '-');
    axios
      .get(
        URL_BACK +
          `/sellTokens/${props.annonces['vendeur'].id}/${user.id}/${props.annonces.nb_tokens}/${props.annonces.id}/${date}`
      )
      .then((res) => {
        if (res.status === 200 || res.status === 201) {
          props.setPopUpActive(false);
          props.setNotifActive('success');
        } else props.setNotifActive('failure');
      });
  };

  return (
    <div className="w-96 bg-blueBg text-white text-xl  font-bold rounded border-2 absolute top-1/2 left-1/2 translate-x-50 translate-y-50 z-20">
      <FontAwesomeIcon
        icon={faXmark}
        className="absolute right-[10px] top-[5px] cursor-pointer"
        onClick={() => props.setPopUpActive(false)}
      />
      <div className="px-8 py-6">
        <p>
          Vous vous apprêtez à acheter {props.annonces.nb_tokens} tokens à{' '}
          {props.annonces['vendeur'].prenom} {props.annonces['vendeur'].nom},
          indiquez vos informations de paiement pour poursuivre.
        </p>
        <Formik
          initialValues={{
            carte_num: '',
            carte_date: '',
            carte_crypto: '',
          }}
          validationSchema={validate}
          onSubmit={buyHandler}
        >
          <Form className="mt-6 w-full max-w-full relative text-center">
            <div className="my-4">
              {' '}
              <label>Numéro de carte</label>
              <InputT name="carte_num" type="text" />
            </div>
            <div className="my-4">
              {' '}
              <label>Date d'expiration</label>
              <InputT name="carte_date" type="date" />
            </div>
            <div className="my-4">
              {' '}
              <label>Cryptogramme visuel</label>
              <InputT name="carte_crypto" type="text" />
            </div>
            <div className="flex justify-between mt-8">
              <button
                className="border-2 py-1 px-3 rounded text-white bg-[#7FC473] hover:bg-[#56B448] cursor-pointer"
                type="submit"
              >
                Confirmer
              </button>
              <button
                className="border-2 py-1 px-3 rounded text-white bg-[#7FC473] hover:bg-red-700 cursor-pointer"
                onClick={() => props.setPopUpActive(false)}
              >
                Annuler
              </button>
            </div>
          </Form>
        </Formik>
      </div>
    </div>
  );
};

export default BuyPopUp;
