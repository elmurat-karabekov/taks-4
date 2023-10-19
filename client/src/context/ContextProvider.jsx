import { createContext, useContext, useEffect, useState } from "react";
import Cookies from "js-cookie";
import axiosClient from "../axios-client";

const StateContext = createContext({});

export const ContextProvider = ({ children }) => {
    const [user, setUser] = useState({});
    const [token, setToken] = useState("dsfds");
    const [notification, _setNotification] = useState("");

    useEffect(() => {
        const storedToken = Cookies.get("token");

        if (storedToken) {
            setToken(storedToken);
        }
    }, []);

    return (
        <StateContext.Provider
            value={{
                user,
                setUser,
                token,
                setToken,
                notification,
                _setNotification,
            }}
        >
            {children}
        </StateContext.Provider>
    );
};

export const useStateContext = () => useContext(StateContext);
