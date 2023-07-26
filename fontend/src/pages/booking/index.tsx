
import Loading from '@/components/Elements/Loading';
import dynamic from 'next/dynamic';
import React from 'react'
const BookingTicketScreen = dynamic(() => import('@/components/Screens/BookingTicket'), {
      loading: () => <Loading />,
      ssr: false,
});
const Layout = dynamic(() => import('@/components/Layouts'));
function index() {
      return (
            <Layout>
                  <BookingTicketScreen />
            </Layout>
      )
}

export default index