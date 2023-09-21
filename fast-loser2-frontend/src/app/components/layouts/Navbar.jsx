import React from 'react';
import { NavLink, useNavigate } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';
import { selectIsLogged, signOut, isAdmin } from '../../redux-store/authenticationSlice';
import { clearUser } from '../../redux-store/userSlice';

const Navbar = () => {
  const isLogged = useSelector((state) => state.auth);
  const user = useSelector((state) => state.user);
  const Admin = useSelector(isAdmin);
  const dispatch = useDispatch();
  const navigate = useNavigate();
  console.log(user);

  return (
    <div className=" items-center bg-[#04ADBF]">
      <div className="flex items-center justify-around h-[8vh] w-[95%] m-autoX">
        <NavLink to="/">
          <img
            className="w-3/4"
            src="/src/app/assets/img/Rectangle54.png"
            alt="logo"
          />
        </NavLink>
        <div className="flex justify-around w-5/12 ">
          <NavLink
            className="text-xl font-bold font-roboto text-white hover:text-[#b2ffa6] my-auto"
            to="/"
          >
            Accueil
          </NavLink>

          <NavLink
            className="text-xl font-bold font-roboto text-white hover:text-[#b2ffa6] my-auto"
            to="/a-propos"
          >
            A propos
          </NavLink>

          {isLogged.isAuthenticated === true ? (
            <NavLink
                className="text-xl font-bold font-roboto text-white hover:text-[#b2ffa6] my-auto"
                to="/ride/post"
            >
              Proposer trajet
            </NavLink>
          ) : (
            <NavLink
                className="hidden text-xl font-bold font-roboto text-white hover:text-[#b2ffa6] my-auto"
                to="/login"
            >
              Proposer trajet
            </NavLink>
          )}

          {isLogged.isAuthenticated === true ? (
            <NavLink
              className="text-xl font-bold font-roboto text-white hover:text-[#b2ffa6] my-auto"
              to="/annonces"
            >
              Annonces
            </NavLink>
          ) : (
            <NavLink
              className="hidden text-xl font-bold font-roboto text-white hover:text-[#b2ffa6] my-auto"
              to="/annonces"
            >
              Annonces
            </NavLink>
          )}

          <NavLink
            className="text-xl font-bold font-roboto text-white hover:text-[#b2ffa6] my-auto"
            to="/ride/search"
          >
            Recherche
          </NavLink>

          {isLogged.isAuthenticated === true ? (
            <NavLink
              className="text-xl font-bold font-roboto text-white hover:text-[#b2ffa6] my-auto"
              to="/Contact"
            >
              Contact
            </NavLink>
          ) : (
            <NavLink
              className="text-xl font-bold font-roboto text-white hover:text-[#b2ffa6] my-auto"
              to="/Login"
            >
              Contact
            </NavLink>
          )}
        </div>

        {isLogged.isAuthenticated === true ? (
          <div>
            {Admin ? (
              <button
                className="font-bold px-4 py-2 rounded-l-xl text-white hover:bg-[#56b448] m-0 transition bg-[#7cc474]"
                onClick={() => window.location.replace('http://localhost:5173/Admin')}
              >
                Tableau de bord
              </button>
            ) : (
              <button
                className="font-bold px-4 py-2 rounded-l-xl text-white hover:bg-[#56b448] m-0 transition bg-[#7cc474]"
                onClick={() => navigate('/Dashboard')}
              >
                Mon profil
              </button>
            )}
            <button
              className="font-bold px-4 py-2 rounded-r-xl bg-neutral-50 hover:bg-neutral-200 transition font-bold"
              onClick={() => dispatch(signOut(), clearUser(), window.location.replace('http://localhost:5173/'))}
            >
              Déconnexion
            </button>
          </div>
        ) : (
          <div className="shadow-xl">
            <NavLink to={'/Login'}>
              <button className="buttonLogin font-bold px-4 py-2 rounded-l-xl text-white hover:bg-[#56b448] m-0 transition bg-[#7cc474]">
                Se connecter
              </button>
            </NavLink>

            <NavLink to={'Inscription'}>
              <button className="buttonRegister px-4 py-2 rounded-r-xl bg-neutral-50 hover:bg-neutral-200 transition font-bold">
                S'inscrire
              </button>
            </NavLink>
          </div>
        )}
      </div>
    </div>
  );
};

export default Navbar;