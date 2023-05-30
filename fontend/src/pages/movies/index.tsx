import React from 'react'
import Layout from '@/components/Layouts'
import MovieScreen from '@/components/Screens/MovieScreen'
function Movies() {
      return (
            <Layout withSearch>
                  <MovieScreen />
            </Layout>
      )
}

export default Movies