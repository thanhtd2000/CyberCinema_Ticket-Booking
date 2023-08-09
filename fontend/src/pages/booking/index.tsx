
import Loading from '@/components/Elements/Loading';
import { LANGUAGE_DEFAULT } from '@/configs/const.config';
import { getLocalStored } from '@/libs/localStorage';
import { queryClient } from '@/queries';
import { GetServerSidePropsContext } from 'next';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';
import dynamic from 'next/dynamic';
import { useRouter } from 'next/router';
import React, { useEffect } from 'react'
import { dehydrate } from 'react-query';
const BookingTicketScreen = dynamic(() => import('@/components/Screens/BookingTicket'), {
      loading: () => <Loading />,
      ssr: false,
});
export async function getServerSideProps({ locale }: GetServerSidePropsContext) {
      return {
        props: {
            ...(await serverSideTranslations(locale || LANGUAGE_DEFAULT, ['movies', 'home'])),
            dehydratedState: dehydrate(queryClient),
        },
      };
    }
const Layout = dynamic(() => import('@/components/Layouts'), {
      loading: () => <Loading />,
      ssr: false,
});
function index() {
      const valueRoom = getLocalStored('valueRoom')
      const router = useRouter(); 
      useEffect(()=>{
            if(!valueRoom){
                  router.push('/404')
            }
      },[])
      return (
            <Layout>
                  <BookingTicketScreen />
            </Layout>
      )
}

export default index