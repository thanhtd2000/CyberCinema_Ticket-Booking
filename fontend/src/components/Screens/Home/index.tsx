import React from 'react';

import Carousel from '@/components/Screens/Home/component/Carousel/Carousel';
import New from '@/components/Screens/Home/component/New/New';
import MainBanner from '@/components/Screens/Home/component/MainBanner/MainBanner';
import { TPost } from '@/modules/post';
import MoviePlaying from './component/MoviePlaying';
import MovieUpcoming from './component/MovieUpcoming';

function HomeScreen() {
  return (
    <div className='home' style={{ background: '#0D0E10' }}>
      <Carousel />
      <MoviePlaying />
      <MovieUpcoming/>
      {/* <Company />
      <Enterprise /> */}
      <MainBanner />
      {/* <Job /> */}
      {/* <Number /> */}
      {/* <New HotNews={HotNews} News={ListNews} /> */}
      {/* <Experience /> */}
    </div>
  );
}

export default HomeScreen;
