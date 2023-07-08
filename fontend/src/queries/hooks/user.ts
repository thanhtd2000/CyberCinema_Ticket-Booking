import { TResApi, TResApiErr } from "@/configs/interface.config";
import { TUser } from "@/modules";
import { useMutation } from "react-query";
import { toast } from "react-toastify";
import { pathProfile } from "../apis";

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
