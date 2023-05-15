import { ELanguage, TBaseData, TQueryParamsGetData } from '@/configs/interface.config';

export type TQueryParamsGetCity = TQueryParamsGetData<{ lang: ELanguage }> & {
  'countryCodes[]'?: string[];
  'countryIds[]'?: string[];
};
// country-city
export type TCountry = TBaseData & { region: string };
export type TCity = Omit<TBaseData, 'code'> & {
  countryCode: string;
  country: string;
};
