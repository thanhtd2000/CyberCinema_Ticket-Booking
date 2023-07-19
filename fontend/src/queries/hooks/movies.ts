import { TResDataListApi } from "@/configs/interface.config";
import { getListMovieBySearch, getListMovieFromDatabase } from "../apis/movies";
import { useQuery } from "react-query";
import { TMovies, TQueryMovies } from "@/modules/movies";
import { LIST_MOVIES, LIST_MOVIES_SEARCH, LIST_MOVIES_SLUG } from "../keys/movies";
import { getListMovieFromDatabaseBySlug } from "../apis/movies";

export const queryAllMovies = () =>
  useQuery<TResDataListApi<TMovies[]>>({
    queryKey: [LIST_MOVIES],
    queryFn: () => getListMovieFromDatabase(),
    refetchOnMount: false,
  });
export const queryAllMoviesBySearch = (params: TQueryMovies) =>
  useQuery<TResDataListApi<TMovies[]>>({
    queryKey: [LIST_MOVIES_SEARCH, JSON.stringify(params)],
    queryFn: () => getListMovieBySearch(params),
    refetchOnMount: false,
  });
export const queryAllMoviesBySlug = (slug:string) =>
  useQuery<TResDataListApi<TMovies[]>>({
    queryKey: [LIST_MOVIES_SLUG],
    queryFn: () => getListMovieFromDatabaseBySlug(slug),
    refetchOnMount: false,
    keepPreviousData: true,
  });