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
  id: string;
  content: string;
  name: string;
  image: string;
  slug: string;
  user: TUser[];
};
