import { TResApi, TResApiErr, TResDataListApi } from "@/configs/interface.config";
import { TUser } from "@/modules";
import { useMutation, useQuery } from "react-query";
import { toast } from "react-toastify";
import { getProfile, pathPassword, pathProfile } from "../apis";
import { HISTORY } from "../keys/movies";
import { USER_PROFILE } from "../keys";

export const useMutationUpdateUser = () =>
  useMutation(({ token, data }: { token: string; data: any }) => pathProfile(token, data), {
    onSuccess: (res: TResApi<TUser>) => {
      toast.success(res?.message, {
        position: toast.POSITION.BOTTOM_RIGHT,
      });
    },
    onError: (error: TResApiErr) => {
      toast.error(error?.message, {
        position: toast.POSITION.BOTTOM_RIGHT,
      });
    },
  });

  export const useMutationUpdatePassword = () =>
  useMutation(({ token, data }: { token: string; data: any }) => pathPassword(token, data), {
    onSuccess: (res: TResApi<TUser>) => {
      toast.success(res?.message, {
        position: toast.POSITION.BOTTOM_RIGHT,
      });
    },
    onError: (error: TResApiErr) => {
      toast.error(error?.message, {
        position: toast.POSITION.BOTTOM_RIGHT,
      });
    },
  });
  export const queryGetProfile = (token: string) =>
  useQuery<TResDataListApi>
  ({
    queryKey: [USER_PROFILE],
    queryFn: () => getProfile(token),
  });