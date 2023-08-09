import Loading from '@/components/Elements/Loading';
import { checkAuth } from '@/libs/localStorage';
import dynamic from 'next/dynamic';
import React, { useEffect } from 'react';
import { useRouter } from 'next/router';
import { GetServerSidePropsContext } from 'next';
import { LANGUAGE_DEFAULT } from '@/configs/const.config';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';
import { queryClient } from '@/queries';
import { dehydrate } from 'react-query';
const HistoryScreen = dynamic(() => import('@/components/Screens/History'), {
  loading: () => <Loading />,
  ssr: false,
});
const Layout = dynamic(() => import('@/components/Layouts'));
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
      router.push('/404');
    }
  }, []);
  return (
    <Layout>
      <HistoryScreen />
    </Layout>
  );
}

export default index;
