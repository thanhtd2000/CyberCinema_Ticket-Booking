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
      schedules: TSchedule[]
}
export type TSchedule = {
      id: string;
      schedule: Date;
}
export type TUpdateStatusChair = {
      status: number | null,
      id: number;
      schedule_id: number;
}
export type TChair = {
      status: number,
      id: string;
      schedule_id: number;
      seat__id: number;
      user_id: number,
      order__id: number,
}
export type TQueryUpdateChair = {
      status: number,
      id: string;
      schedule_id: number;
}