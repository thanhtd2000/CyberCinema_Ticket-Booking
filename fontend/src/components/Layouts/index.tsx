import React, { HTMLAttributes, PropsWithChildren } from 'react';
import { ToastContainer } from 'react-toastify';

import Footer from './Footer';
import Head, { THead } from './Head';
import HeaderSearch from './HeaderSearch/HeaderSearch';
import Header from './Header';
export interface ILayoutProps {
  withSearch?: boolean;
}
type PageProps = PropsWithChildren<THead> & HTMLAttributes<HTMLDivElement> & ILayoutProps;
function Layout(props: PageProps) {
  const { children, withSearch } = props;
  return (
    <>
      <Head {...props} />
      {withSearch ? <HeaderSearch /> : <Header />}
      {children}
      <Footer />
      <ToastContainer
        position='top-right'
        autoClose={5000}
        hideProgressBar={false}
        newestOnTop={false}
        closeOnClick
        rtl={false}
        pauseOnFocusLoss
        draggable
        pauseOnHover
        theme='light'
      />
    </>
  );
}

export default Layout;
