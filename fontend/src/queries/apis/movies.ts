import { request } from '@/configs/api.config';
import { ELanguage } from '@/configs/interface.config';
import { TMovies, TQueryMovies } from '@/modules/movies';
export const getListMovieFromDatabase = () =>
  request({ url: '/get/movies ', method: 'GET' });
export const getListMovieBySearch = (params:TQueryMovies) =>
  request({ url: '/get/movies', method: 'GET', params: { ...params } });
  export const getListMovieFromDatabaseBySlug = (slug:string) =>
  request({ url: `/get/movie/detail/${slug}`, method: 'GET' });