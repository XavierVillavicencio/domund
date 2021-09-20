import { createContext, useState } from "react";

export const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null);

  const login = () => {
    setUser({ name: "Username" });
  };

  const logout = () => {
    setUser(null);
  };

  const isLogged = () => {
    return !!user;
  };

  return (
    <AuthContext.Provider value={{ user, login, logout, isLogged }}>
      {children}
    </AuthContext.Provider>
  );
};
