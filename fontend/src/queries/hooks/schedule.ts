import { TResApi, TResDataListApi } from "@/configs/interface.config";
import { getListChair, getListRoom, getListSchedule } from "../apis/schedule";
import { useMutation, useQuery, useQueryClient } from "react-query";
import { LIST_CHAIR, LIST_ROOM, LIST_SCHEDULE } from "../keys/movies";
import { TQueryMovies } from "@/modules/movies";
import { TSchedule } from "@/modules/schedule";
import { checkAuth } from "@/libs/localStorage";
import { useGlobalState } from "@/libs/GlobalStateContext";
import { toast } from "react-toastify";

export const queryAllHours = (params: TQueryMovies, enable: boolean) =>
  useQuery<TResDataListApi>({
    queryKey: [LIST_SCHEDULE, JSON.stringify(params)],
    queryFn: () => getListSchedule(params),
    refetchOnMount: false,
    keepPreviousData: true,
    enabled: enable
  });
  export const queryAllRoom = (params: TQueryMovies,enable: boolean) =>
  useQuery<TResDataListApi>({
    queryKey: [LIST_ROOM, JSON.stringify(params)],
    queryFn: () => getListRoom(params),
    refetchOnMount: false,
    keepPreviousData: true,
    enabled: enable
  });
  export const queryAllChair= ( body: TSchedule,token: string) =>
  useQuery<TResDataListApi>({
    queryKey: [LIST_CHAIR],
    queryFn: () => getListChair(body,token),
    refetchOnMount: false,
    keepPreviousData: true,
  });
  export const useMutationGetRoom = () => {
      const queryClient = useQueryClient();
      
      return useMutation(({body, token}:{body: TSchedule, token: string}) => getListChair(body,token), {
        onSuccess: async (res: TResApi) => {

          
        },
        onError: (error) => {
      //     toast.error(error.message || error.statusText);
        },
        onSettled: () => {
          queryClient.invalidateQueries();
        },
      });
    };