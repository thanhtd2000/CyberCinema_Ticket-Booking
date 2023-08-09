import Loading from '@/components/Elements/Loading';
import { LANGUAGE_DEFAULT } from '@/configs/const.config';
import { queryClient } from '@/queries';
import { GetServerSidePropsContext } from 'next';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';
import dynamic from 'next/dynamic';
import React from 'react'
import { dehydrate } from 'react-query';
const MovieScreen = dynamic(() => import('@/components/Screens/MovieScreen'), {
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
function Movies() {
      return (
            <Layout>
                  <MovieScreen />
            </Layout>
      )
}

export default Movies