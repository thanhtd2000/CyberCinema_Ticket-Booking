import React from 'react';
import { Pagination } from 'antd';
export interface IPagination {
  min: number;
  max: number;
}
function PaginationCustom({ min, max }: IPagination) {
  return <Pagination defaultCurrent={min} total={max} />;
}

export default PaginationCustom;
