import Loading from '@/components/Elements/Loading';
import { checkAuth } from '@/libs/localStorage';
import dynamic from 'next/dynamic';
import React, { useEffect } from 'react'
import { useRouter } from 'next/router';
import { GetServerSidePropsContext } from 'next';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';
import { LANGUAGE_DEFAULT } from '@/configs/const.config';
import { queryClient } from '@/queries';
import { dehydrate } from 'react-query';
const UserScreen = dynamic(() => import('@/components/Screens/User'), {
      loading: () => <Loading />,
      ssr: false,
});
const Layout = dynamic(() => import('@/components/Layouts'), {
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
function index() {
      const token = checkAuth();
      const router = useRouter();
      useEffect(() => {
            if (!token) {
                  router.push('/404')
            }
      }, [])
      return (
            <Layout>
                  <UserScreen />
            </Layout>
      )
}

export default index