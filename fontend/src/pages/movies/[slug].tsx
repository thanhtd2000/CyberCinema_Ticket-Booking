import React from 'react'
import { GetServerSidePropsContext, InferGetServerSidePropsType } from 'next';
import { getListMovieFromDatabaseBySlug } from '@/queries/apis/movies';
import dynamic from 'next/dynamic';
import Loading from '@/components/Elements/Loading';
const MovieDetailScreen = dynamic(() => import('@/components/Screens/MovieDetail'), {
      loading: () => <Loading />,
      ssr: false,
});
const Layout = dynamic(() => import('@/components/Layouts'));
export async function getServerSideProps({ params }: GetServerSidePropsContext) {
      const moviesDetail = await getListMovieFromDatabaseBySlug(params?.slug as string)
      return {
        props: {
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