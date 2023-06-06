import React, { useState } from 'react'
import Layout from '@/components/Layouts'
import MovieDetailScreen from '@/components/Screens/MovieDetail'
import { GetServerSidePropsContext, InferGetServerSidePropsType } from 'next';
import { getListMovieFromDatabaseBySlug } from '@/queries/apis/movies';
export async function getServerSideProps({ params }: GetServerSidePropsContext) {
      const movieDetailSlug = await getListMovieFromDatabaseBySlug(params?.slug as string)
      const moviesDetail = movieDetailSlug.data
      return {
        props: {
            moviesDetail
        },
      };
    }
function Movies(props: InferGetServerSidePropsType<typeof getServerSideProps> ) {
      const {moviesDetail} = props 
      console.log(moviesDetail);
  return (
    <Layout>
      {
            moviesDetail && (<MovieDetailScreen moviesDetail={moviesDetail}/>)
      }
    </Layout>
  )
}

export default Movies