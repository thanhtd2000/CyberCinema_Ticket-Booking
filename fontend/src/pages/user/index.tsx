import Loading from '@/components/Elements/Loading';
import dynamic from 'next/dynamic';
import React from 'react'
const UserScreen = dynamic(() => import('@/components/Screens/User'), {
      loading: () => <Loading />,
      ssr: false,
});
const Layout = dynamic(() => import('@/components/Layouts'));
function index() {
  return (
    <Layout>
      <UserScreen />
    </Layout>
  )
}

export default index