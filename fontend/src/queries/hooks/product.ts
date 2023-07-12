
import { TResDataListApi } from "@/configs/interface.config";
import { LIST_DISCOUNT, LIST_DISCOUNT_DETAIL, LIST_PRODUCT } from "../keys/product";
import { useQuery } from "react-query";
import { getListDiscount, getListDiscountDetail, getListProduct } from "../apis/product";
import { TDiscount, TProduct } from "@/modules/product";
import { TQueryCode } from "@/modules/movies";

export const queryAllProduct = () =>
  useQuery<TResDataListApi<TProduct[]>>({
    queryKey: [LIST_PRODUCT],
    queryFn: () => getListProduct(),
    refetchOnMount: false,
    keepPreviousData: true,
  });
  export const queryAllDiscount = (token: string) =>
  useQuery<TResDataListApi<TDiscount[]>>({
    queryKey: [LIST_DISCOUNT],
    queryFn: () => getListDiscount(token),
    refetchOnMount: false,
    keepPreviousData: true,
  });
  export const queryDiscountDetail = (token: string, params: TQueryCode, enabled: boolean) =>
  useQuery<TResDataListApi<TDiscount[]>>({
    queryKey: [LIST_DISCOUNT_DETAIL, JSON.stringify(params)],
    queryFn: () => getListDiscountDetail(token, params),
    refetchOnMount: false,
    keepPreviousData: true,
    enabled: enabled
  });