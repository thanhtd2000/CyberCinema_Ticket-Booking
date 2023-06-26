import { TResDataListApi } from '@/configs/interface.config';
import { getListChair, getListRoom, getListSchedule } from '../apis/schedule';
import { useQuery } from 'react-query';
import { LIST_CHAIR, LIST_ROOM, LIST_SCHEDULE } from '../keys/movies';
import { TQueryMovies } from '@/modules/movies';
import { TSchedule } from '@/modules/schedule';

export const queryAllHours = (params: TQueryMovies, enable: boolean) =>
  useQuery<TResDataListApi>({
    queryKey: [LIST_SCHEDULE, JSON.stringify(params)],
    queryFn: () => getListSchedule(params),
    refetchOnMount: false,
    enabled: enable,
  });
export const queryAllRoom = (params: TQueryMovies, enable: boolean) =>
  useQuery<TResDataListApi>({
    queryKey: [LIST_ROOM, JSON.stringify(params)],
    queryFn: () => getListRoom(params),
    refetchOnMount: false,
    enabled: enable,
  });
export const queryAllChair = (body: TSchedule, token: string) =>
  useQuery<TResDataListApi>({
    queryKey: [LIST_CHAIR],
    queryFn: () => getListChair(body, token),
    refetchOnMount: false,
  });
