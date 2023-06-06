
import React, { useState } from 'react'
import style from './style.module.less'
import { Breadcrumb, Col, Row, Select } from 'antd';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import MovieItem from '@/components/Elements/MovieItem';
import { TMovies, TQueryMovies } from '@/modules/movies';
import { handleFilter } from '@/libs/const';
import { EOrderBy } from '@/configs/interface.config';
import { queryAllMoviesBySearch } from '@/queries/hooks/movies';
import { baseParams } from '@/configs/const.config';
function MovieScreen() {
      const [params, setParams] = useState<TQueryMovies>();
      const handleChange = (value: string) => {
            setParams({
                  ...params,
                  orderBy: handleFilter(value).orderBy as EOrderBy,
                  order: handleFilter(value).order,
            });
      };
      const {data : movies}= queryAllMoviesBySearch({
            ...baseParams,...params
      })
      const moviesList = movies?.data
      return (
            <div className={`${style.movies} moviesDetail`} style={{ background: '#0D0E10' }}>
                  <div className='container'>
                        <div>
                              <Breadcrumb
                                    style={{ color: 'rgb(183, 177, 177)', paddingBottom: '30px', fontSize: '17px' }}
                                    items={[
                                          {
                                                title: 'Home',
                                          },
                                          {
                                                title: <a href="" style={{ color: 'white' }}>Movies</a>,
                                          }
                                    ]}
                              />
                        </div>
                        <div className={style.sortMovie}>
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
                        </div>
                        <div>
                              <Row>
                                    <Col span={24}>
                                          <Row gutter={[{ xs: 0, sm: 20, md: 20, lg: 35, xl: 50 }, 50]}>
                                                {moviesList && moviesList ? moviesList?.map((item) => (<MovieItem movies={item} />)) : <div>loading...</div>}
                                          </Row>
                                    </Col>
                              </Row>
                        </div>
                  </div>
            </div>
      )
}

export default MovieScreen