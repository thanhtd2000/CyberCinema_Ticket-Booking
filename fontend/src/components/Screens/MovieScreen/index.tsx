import React, { useState } from 'react';
import style from './style.module.less';
import { Breadcrumb, Col, Row, Select, Spin, Input } from 'antd';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import MovieItem from '@/components/Elements/MovieItem';
import { TQueryMovies } from '@/modules/movies';
import { handleFilter } from '@/libs/const';
import { EOrderBy } from '@/configs/interface.config';
import { queryAllMoviesBySearch } from '@/queries/hooks/movies';
import { baseParams } from '@/configs/const.config';
import Link from 'next/link';
const { Search } = Input;
function MovieScreen() {
      const [params, setParams] = useState<TQueryMovies>();
      const handleChange = (value: string) => {
            setParams({
                  ...params,
                  orderBy: handleFilter(value).orderBy as EOrderBy,
                  order: handleFilter(value).order,
            });
      };
      const { data: movies, isLoading: loading, isFetching } = queryAllMoviesBySearch({
            ...baseParams,
            ...params,
      });
      const onSearch = (value: string) => {
            // router.push({ pathname: '/search', query: { s: value } });
            setParams({ ...params, s: value });
      };
      const moviesList = movies?.data;
      return (
            <div style={{ background: '#0D0E10' }}>
                  <div className='container' style={{ background: '#0D0E10' }}>
                        <div className={`${style.movies} moviesDetail`} style={{ background: '#0D0E10' }}>
                              <div>
                                    <Breadcrumb
                                          style={{ color: 'rgb(183, 177, 177)', paddingBottom: '30px', fontSize: '17px' }}
                                          items={[
                                                {
                                                      title: (
                                                            <Link style={{ color: '#999' }} href='/'>
                                                                  Home
                                                            </Link>
                                                      ),
                                                },
                                                {
                                                      title: (
                                                            <a href='' style={{ color: 'white' }}>
                                                                  Movies
                                                            </a>
                                                      ),
                                                },
                                          ]}
                                    />
                              </div>
                              <div className={style.sortMovie}>
                                    <Row style={{ justifyContent: 'space-between', width: '100%' }} gutter={[0, 24]}>
                                          <Col xs={24} sm={24} md={10} style={{ display: 'flex', alignItems: 'center' }}>
                                                <Search className={style.search} onSearch={onSearch} placeholder='Nhập tên phim' enterButton />
                                          </Col>
                                          <Col>
                                                <Select
                                                      value={params?.order === 'ASC' ? `-${params?.orderBy}` : `${params?.orderBy || 'date'}`}
                                                      className={style.sort}
                                                      defaultValue='createdAt'
                                                      style={{ width: 150 }}
                                                      onChange={handleChange}
                                                      options={[
                                                            { value: 'date', label: 'Mới nhất' },
                                                            { value: '-date', label: 'Cũ nhất' },
                                                            { value: '-name', label: 'A-Z' },
                                                            { value: 'name', label: 'Z-A' },
                                                            { value: 'viewer', label: 'Nhiều view nhất' },
                                                      ]}
                                                />
                                          </Col>
                                    </Row>
                              </div>
                              <div>
                                    <Row>
                                          <Col span={24}>
                                                {moviesList && !loading || !isFetching ? (
                                                      <Row gutter={[{ xs: 0, sm: 20, md: 20, lg: 35, xl: 50 }, 50]}>
                                                            {moviesList?.map((item) => (
                                                                  <MovieItem movies={item} />
                                                            ))}
                                                      </Row>
                                                ) : (
                                                      <div style={{ width: '100%', textAlign: 'center', minHeight: '300px' }}>
                                                            <Spin></Spin>
                                                      </div>
                                                )}
                                          </Col>
                                    </Row>
                              </div>
                        </div>
                  </div>
            </div>
      );
}

export default MovieScreen;
