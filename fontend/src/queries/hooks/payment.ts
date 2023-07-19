import { TResDataListApi } from "@/configs/interface.config";
import { TQueryPayment } from "@/modules/movies";
import { useQuery } from "react-query";
import { getHistory, getPayment } from "../apis/payment";
import { HISTORY, PAYMENT } from "../keys/movies";

export const queryPayment = (params: TQueryPayment, token: string) =>
  useQuery<TResDataListApi>
  ({
    queryKey: [PAYMENT, JSON.stringify(params)],
    queryFn: () => getPayment(params, token),
    refetchOnMount: false,
    keepPreviousData: true,
  });
export const queryHistory = (token: string) =>
  useQuery<TResDataListApi>
  ({
    queryKey: [HISTORY],
    queryFn: () => getHistory(token),
    refetchOnMount: false,
    keepPreviousData: true,
  });