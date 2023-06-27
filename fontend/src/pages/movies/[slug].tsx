import React from 'react'
import Layout from '@/components/Layouts'
import MovieDetailScreen from '@/components/Screens/MovieDetail'
import { GetServerSidePropsContext, InferGetServerSidePropsType } from 'next';
import { getListMovieFromDatabaseBySlug } from '@/queries/apis/movies';
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