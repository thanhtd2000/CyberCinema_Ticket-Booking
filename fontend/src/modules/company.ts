/* eslint-disable import/no-cycle */
import { ELanguage, EStatusDoc, TQueryParamsGetData } from '@/configs/interface.config';

import { TCategory } from './category';
import { TFile } from './media';
import { TCity, TCountry } from './countryCity';
// import { TCity, TCountry } from './countryCity';
// import { TIncorporationType } from './incorporationType';
// import { TFile } from './media';
// import { TPortfolio } from './portfolio';
// import { TProduct } from './product';
// import { TService } from './services';
// import { TTechnology } from './technology';

export type TQueryParamsGetCompany = TQueryParamsGetData<{
  taxCode?: string;
  typical?: number;
  country?: string;
  city?: string;
  incorporationType?: string;
  'categoryIds[]'?: string[];
  'technologyIds[]'?: string[];
  'partner[]'?: string[];
  'member[]'?: string[];
  lang?: ELanguage;
}>;

export type TCompany = {
  _id: string;
  name: string;
  nameSort: string;
  slug: string;
  internationalName: string;
  internationalNameSort: string;
  taxCode: string;
  keyword: string;
  country: TCountry;
  city: TCity;
  address: string;
  representative: string;
  phone: string;
  email: string;
  foundationDate: Date;
  website: string;
  companySize: number;
  incorporationType: TIncorporationType;
  coverPhoto: TFile;
  logo: TFile;
  gallery: TFile[];
  documents: TFile[];
  videos: TFile[];
  excerpt: TFile[];
  description: string;
  categories: TCategory[];
  technologies: TTechnology[];
  portfolio: TPortfolio[];
  businessStatus: string;
  partners: string[];
  memberCompanies: string[];
  members: string[];
  viewer: number;
  status: EStatusDoc;
  publishedLanguage: ELanguage[];
  isSupported: boolean;
  createdAt: Date;
  products: TProduct[];
  services: TService[];
};
export type TDataProduct = Partial<TCompany> & {
  data: TProduct[];
};
export enum ETab {
  GENERAL = 'GENERAL',
  PORTFOLIO = 'PORTFOLIO',
  SERVICE = 'SERVICE',
  PRODUCT = 'PRODUCT',
}
