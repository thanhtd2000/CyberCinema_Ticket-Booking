import { request } from "@/configs/api.config";
import { TQueryMovies } from "@/modules/movies";
import { TSchedule } from "@/modules/schedule";

export const getListSchedule = (params:TQueryMovies) =>
  request({ url: '/get/schedule', method: 'GET', params: { ...params } });
  export const getListRoom = (params:TQueryMovies) =>
  request({ url: '/get/schedule/room', method: 'GET', params: { ...params } });
  export const getListChair = (body:TSchedule,token: string) =>
  request({ url: '/get/room', method: 'POST', data: body },{ token });