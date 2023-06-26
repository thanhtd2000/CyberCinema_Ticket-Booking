import React, { createContext, useContext, useState } from 'react';

interface GlobalState {
  // Define your global state type here
}

interface GlobalStateContextProps {
  globalState: GlobalState;
  setGlobalState: React.Dispatch<React.SetStateAction<GlobalState>>;
}

interface GlobalStateProviderProps {
  children: React.ReactNode;
}

export const GlobalStateContext = createContext<GlobalStateContextProps | undefined>(undefined);

export const GlobalStateProvider: React.FC<GlobalStateProviderProps> = ({ children }) => {
  const [globalState, setGlobalState] = useState<GlobalState>(/* initial state here */);

  return (
    <GlobalStateContext.Provider value={{ globalState, setGlobalState }}>
      {children}
    </GlobalStateContext.Provider>
  );
};
export const useGlobalState = (): GlobalStateContextProps => {
      const context = useContext(GlobalStateContext);
      if (!context) {
        throw new Error('useGlobalState must be used within a GlobalStateProvider');
      }
      return context;
    };