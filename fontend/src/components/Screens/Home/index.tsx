import React from 'react';

import Carousel from '@/components/Screens/Home/component/Carousel/Carousel';
import New from '@/components/Screens/Home/component/New/New';
import MoviePlaying from './component/MoviePlaying';
import MovieUpcoming from './component/MovieUpcoming';
import { TMovies } from '@/modules/movies';
import dayjs from 'dayjs';
import { TPost } from '@/modules/post';
interface IHomeScreen{
      fetchAllMovies: TMovies[];
      HotNews: TPost[],
}
function HomeScreen({fetchAllMovies, HotNews}:IHomeScreen) {
      const listMoviesUpComing = fetchAllMovies.filter(item=> dayjs(item?.date).isAfter(dayjs()) === true)
      const listMoviesPlaying  = fetchAllMovies.filter(item=> dayjs(item?.date).isAfter(dayjs()) === false)
      console.log(HotNews);
      const listHotNews = HotNews.slice(0,2)
      const listItem = HotNews.slice(2,5)
  return (
    <div className='home' style={{ background: '#0D0E10' }}>
      <Carousel />
      <MoviePlaying fetchAllMovies={listMoviesPlaying} />
      <MovieUpcoming fetchAllMovies={listMoviesUpComing}/>
      <New HotNews={listHotNews} News={listItem} />
    </div>
  );
}     

export default HomeScreen;
