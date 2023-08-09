import React from 'react'
import { GetServerSidePropsContext, InferGetServerSidePropsType } from 'next';
import { getListMovieFromDatabaseBySlug } from '@/queries/apis/movies';
import dynamic from 'next/dynamic';
import Loading from '@/components/Elements/Loading';
import { serverSideTranslations } from 'next-i18next/serverSideTranslations';
import { LANGUAGE_DEFAULT } from '@/configs/const.config';
import { queryClient } from '@/queries';
import { dehydrate } from 'react-query';
const MovieDetailScreen = dynamic(() => import('@/components/Screens/MovieDetail'), {
      loading: () => <Loading />,
      ssr: false,
});
const Layout = dynamic(() => import('@/components/Layouts'),{
      loading: () => <Loading />,
      ssr: false,
});
export async function getServerSideProps({ params,locale }: GetServerSidePropsContext) {
      const moviesDetail = await getListMovieFromDatabaseBySlug(params?.slug as string)
      return {
        props: {
            ...(await serverSideTranslations(locale || LANGUAGE_DEFAULT, ['movies', 'home'])),
            dehydratedState: dehydrate(queryClient),
            moviesDetail
        },
      };
    }
function Movies(props: InferGetServerSidePropsType<typeof getServerSideProps> ) {
      const {moviesDetail} = props 
      
  return (
    <Layout>
      {
            moviesDetail && (<MovieDetailScreen moviesDetail={moviesDetail}/>)
      }
    </Layout>
  )
}

export default Movies