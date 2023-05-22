import { ELanguage, EStatusDoc, TQueryParamsGetData } from '@/configs/interface.config';

import { TUser } from './user';
import { TFile } from './media';
import { TTaxonomy } from './taxonomy';
import { TCategory } from './category';

export type TQueryPost = TQueryParamsGetData<{
  'taxonomyIds[]'?: string[] | string;
  isHot?: number;
  companyId?: string;
  // postType: string;
}>;
export type TSource = {
  name: string;
  url: string;
};
export type TPost = {
  _id: string;
  keyword: string;
  author: TUser;
  editedBy: string;
  status: EStatusDoc;
  publishedLanguage: ELanguage[];
  name: string;
  slug: string;
  content: string;
  excerpt: string;
  thumbnail: TFile;
  taxonomies: TTaxonomy[];
  categories: TCategory[];
  scheduleAt: Date;
  viewer: number;
  nameSort: string;
  createdAt: Date;
  updatedAt: Date;
  __v: number;
  source: TSource;
};
