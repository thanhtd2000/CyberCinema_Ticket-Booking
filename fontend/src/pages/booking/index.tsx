
import Loading from '@/components/Elements/Loading';
import { getLocalStored } from '@/libs/localStorage';
import dynamic from 'next/dynamic';
import { useRouter } from 'next/router';
import React, { useEffect } from 'react'
const BookingTicketScreen = dynamic(() => import('@/components/Screens/BookingTicket'), {
      loading: () => <Loading />,
      ssr: false,
});
const Layout = dynamic(() => import('@/components/Layouts'));
function index() {
      const valueRoom = getLocalStored('valueRoom')
      const router = useRouter(); 
      useEffect(()=>{
            if(!valueRoom){
                  router.push('/404')
            }
      },[])
      return (
            <Layout>
                  <BookingTicketScreen />
            </Layout>
      )
}

export default index