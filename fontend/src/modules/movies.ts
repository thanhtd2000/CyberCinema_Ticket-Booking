import { TQueryParamsGetData } from "@/configs/interface.config";
import { TDirector } from "./director";
import { TCategory } from "./category";
import { TActor } from "./actor";

export type TQueryMovies = TQueryParamsGetData<{
      isHot?: number;
    }>;
export type TMovies = {
      _id: string;
      name: string;
      description: string;
      actor: TActor[];
      data: Date;
      time: string;
      director: TDirector[];
      category: TCategory[];
      trailer: string;
      date: Date;
      language: string;
      image: string;
      year_old: number;
      price: number;
      slug: string;
      isHot: number;
      createdAt: Date;
      updatedAt: Date;
}