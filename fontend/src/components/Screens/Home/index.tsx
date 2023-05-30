import React from 'react';

import Carousel from '@/components/Screens/Home/component/Carousel/Carousel';
import New from '@/components/Screens/Home/component/New/New';
import MainBanner from '@/components/Screens/Home/component/MainBanner/MainBanner';
import MoviePlaying from './component/MoviePlaying';
import MovieUpcoming from './component/MovieUpcoming';
import { TMovies } from '@/modules/movies';
import dayjs from 'dayjs';
interface movies{
      fetchAllMovies: TMovies[];
}
function HomeScreen({fetchAllMovies}:movies) {
      const listMoviesUpComing = fetchAllMovies.filter(item=> dayjs(item?.date).isAfter(dayjs()) === true)
      const listMoviesPlaying  = fetchAllMovies.filter(item=> dayjs(item?.date).isAfter(dayjs()) === false)
      console.log(listMoviesUpComing);
  return (
    <div className='home' style={{ background: '#0D0E10' }}>
      <Carousel />
      <MoviePlaying fetchAllMovies={listMoviesPlaying} />
      <MovieUpcoming fetchAllMovies={listMoviesUpComing}/>
      <MainBanner />
      {/* <Job /> */}
      {/* <Number /> */}
      {/* <New HotNews={HotNews} News={ListNews} /> */}
      {/* <Experience /> */}
    </div>
  );
}

export default HomeScreen;
