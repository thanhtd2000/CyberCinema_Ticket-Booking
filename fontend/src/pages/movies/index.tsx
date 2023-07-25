import Loading from '@/components/Elements/Loading';
import dynamic from 'next/dynamic';
import React from 'react'
const MovieScreen = dynamic(() => import('@/components/Screens/MovieScreen'), {
      loading: () => <Loading />,
      ssr: false,
});
const Layout = dynamic(() => import('@/components/Layouts'));
function Movies() {
      return (
            <Layout>
                  <MovieScreen />
            </Layout>
      )
}

export default Movies