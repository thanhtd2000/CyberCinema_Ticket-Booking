import { TResApi, TResApiErr, TResDataListApi } from "@/configs/interface.config";
import { TUser } from "@/modules";
import { useMutation, useQuery } from "react-query";
import { toast } from "react-toastify";
import { getCheckCode, getContact, getNewPassword, getProfile, pathPassword, pathProfile } from "../apis";
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
  export const queryGetProfile = (token: any) =>
  useQuery<TResDataListApi>
  ({
    queryKey: [USER_PROFILE],
    queryFn: () => getProfile(token),
    enabled: !!token,
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
    export const useQueryGetNewEmail = () =>
    useMutation(({ data }: {data: any }) => getNewPassword(data), {
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
    export const useQueryCheckCode = () =>
    useMutation(({ data }: {data: any }) => getCheckCode(data), {
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
    export const useQueryContact = () =>
    useMutation(({ data }: {data: any }) => getContact(data), {
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