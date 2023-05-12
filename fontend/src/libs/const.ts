import { NextRouter } from 'next/router';

import { ELanguage, EOrder, EOrderBy } from '@/configs/interface.config';

export const handleFilter = (value: string) => {
  const params = {
    order: EOrder.DESC,
    orderBy: value || EOrderBy.CREATED_DATE,
  };
  if (value?.toString()?.charAt(0) === '-') {
    params.order = EOrder.ASC;
    params.orderBy = value.toString().substr(1, value.length);
  }
  return params;
};

export const handleChangeLanguage = (router: NextRouter) => {
  const { pathname, asPath, query } = router;
  if (router?.locale === ELanguage.EN) {
    router.replace({ pathname, query }, asPath, { locale: ELanguage.VI });
  } else {
    router.replace({ pathname, query }, asPath, { locale: ELanguage.EN });
  }
};
