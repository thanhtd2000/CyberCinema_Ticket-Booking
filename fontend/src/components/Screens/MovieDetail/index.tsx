import React from 'react'
import style from './style.module.less'
import { Breadcrumb, Col, Form, Row, Select, Tag } from 'antd';
import Image from 'next/image';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import VideoIframe from '@/components/Elements/VideoTrailer';
import ReactPlayer from 'react-player';
import { TMovies } from '@/modules/movies';
import dayjs from 'dayjs';
interface moviesDetaiil {
      moviesDetail: TMovies[],
}
function MovieDetailScreen({ moviesDetail }: moviesDetaiil) {
      const videoLink = moviesDetail[0].trailer
      const videoTitle = moviesDetail[0].name;
      const handleChange = (value: string) => {
            console.log(`selected ${value}`);
      };
      const onFinish = (values: any) => {
            console.log('Success:', values);
      };
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
                                                title: <span style={{ color: 'white' }}>{moviesDetail[0].name}</span>,
                                          }
                                    ]}
                              />
                        </div>
                        <div>
                              <Row gutter={[{ sm: 0, md: 30, lg: 50 }, 0]}>
                                    <Col xs={24} md={8} className={style.movieLeft}>
                                          <Image src={moviesDetail[0].image} width={500} height={620} alt='banner' />
                                    </Col>
                                    <Col xs={24} md={16} className={style.movieRight}>
                                          <Row>
                                                <Col span={24}><h1>{moviesDetail[0].name}</h1></Col>
                                                <Col span={24} style={{ paddingTop: '12px', paddingBottom: '24px', color: 'rgb(171, 171, 171)' }}>
                                                      <Row>
                                                            <Col style={{ paddingRight: '15px' }}>{dayjs(moviesDetail[0].date).format('YYYY')}</Col>
                                                            <Col className={style.time}>{moviesDetail[0].time}</Col>
                                                            <Col style={{ paddingLeft: '15px' }}>16+</Col>
                                                      </Row>
                                                </Col>
                                                <Col className={style.overview}>
                                                      <h3>OVERVIEW</h3>
                                                      <ul className={style.overDetail}>
                                                            <li>
                                                                  <p>{moviesDetail[0].description}</p>
                                                            </li>
                                                            <li>
                                                                  <span>Time Premiere : </span>
                                                                  <p>{dayjs(moviesDetail[0].date).format('DD/MM/YYYY')}</p>
                                                            </li>
                                                            <li>
                                                                  <span>Directors : </span>
                                                                  <p>{moviesDetail[0]?.director[0]?.name}</p>
                                                            </li>
                                                            <li>
                                                                  <span>Categories : </span>
                                                                  <p>{moviesDetail[0]?.category.map((item) => (<Tag className={style.tag}>{item.name}</Tag>))}</p>
                                                            </li>
                                                      </ul>
                                                </Col>
                                                <Col span={24}>
                                                      <Row style={{ justifyContent: 'space-between', alignItems: 'center' }}>
                                                            <h3 style={{ color: 'rgb(236, 229, 229)', fontSize: '25px', padding: '10px 0', fontWeight: '500' }}>Actors</h3>
                                                      </Row>
                                                </Col>
                                                <Col className={style.actor}>
                                                      {
                                                            moviesDetail[0]?.actor.map((item) => (<div className={style.actorItem}>
                                                                  <Image src='/images/movies/actor1.jpg' width={80} height={80} alt='actor' />
                                                                  <p>{item?.name}</p>
                                                            </div>))
                                                      }
                                                </Col>
                                          </Row>
                                    </Col>
                              </Row>
                        </div>
                        {
                              dayjs(moviesDetail[0]?.date).isAfter(dayjs()) === true ? ('') : (<Form onFinish={onFinish}>
                                    <div>
                                          <Row className={style.date}>
                                                <Col span={24}>
                                                      <h3>
                                                            Chọn Ngày
                                                      </h3>
                                                </Col>
                                                <Col xs={24} sm={18} md={16} lg={14} style={{ overflow: 'hidden' }}>
                                                      <Row className={style.listDate}>
                                                            <Col className={style.dateItem}>
                                                                  <div>
                                                                        <p className={style.selectMonth}>Thứ ba</p>
                                                                        <p className={style.selectDate}>1</p>
                                                                        <p className={style.selectMonth}>Tháng 1</p>
                                                                  </div>
                                                            </Col>
                                                            <Col className={style.dateItem}>
                                                                  <div>
                                                                        <p className={style.selectMonth}>Thứ ba</p>
                                                                        <p className={style.selectDate}>2</p>
                                                                        <p className={style.selectMonth}>Tháng 2</p>
                                                                  </div>
                                                            </Col>
                                                            <Col className={style.dateItem}>
                                                                  <div>
                                                                        <p className={style.selectMonth}>Thứ ba</p>
                                                                        <p className={style.selectDate}>3</p>
                                                                        <p className={style.selectMonth}>Tháng 3</p>
                                                                  </div>
                                                            </Col>
                                                            <Col className={style.dateItem}>
                                                                  <div>
                                                                        <p className={style.selectMonth}>Thứ ba</p>
                                                                        <p className={style.selectDate}>4</p>
                                                                        <p className={style.selectMonth}>Tháng 4</p>
                                                                  </div>
                                                            </Col>
                                                            <Col className={style.dateItem}>
                                                                  <div>
                                                                        <p className={style.selectMonth}>Thứ ba</p>
                                                                        <p className={style.selectDate}>15</p>
                                                                        <p className={style.selectMonth}>Tháng 5</p>
                                                                  </div>
                                                            </Col>
                                                            <Col className={style.dateItem}>
                                                                  <div>
                                                                        <p className={style.selectMonth}>Thứ ba</p>
                                                                        <p className={style.selectDate}>6</p>
                                                                        <p className={style.selectMonth}>Tháng 6</p>
                                                                  </div>
                                                            </Col>
                                                            <Col className={style.dateItem}>
                                                                  <div>
                                                                        <p className={style.selectMonth}>Thứ ba</p>
                                                                        <p className={style.selectDate}>1</p>
                                                                        <p className={style.selectMonth}>Tháng 1</p>
                                                                  </div>
                                                            </Col>
                                                            <Col className={style.dateItem}>
                                                                  <div>
                                                                        <p className={style.selectMonth}>Thứ ba</p>
                                                                        <p className={style.selectDate}>1</p>
                                                                        <p className={style.selectMonth}>Tháng 1</p>
                                                                  </div>
                                                            </Col>
                                                            <Col className={style.dateItem}>
                                                                  <div>
                                                                        <p className={style.selectMonth}>Thứ ba</p>
                                                                        <p className={style.selectDate}>1</p>
                                                                        <p className={style.selectMonth}>Tháng 1</p>
                                                                  </div>
                                                            </Col>
                                                            <Col className={style.dateItem}>
                                                                  <div>
                                                                        <p className={style.selectMonth}>Thứ ba</p>
                                                                        <p className={style.selectDate}>1</p>
                                                                        <p className={style.selectMonth}>Tháng 1</p>
                                                                  </div>
                                                            </Col>
                                                            <Col className={style.dateItem}>
                                                                  <div>
                                                                        <p className={style.selectMonth}>Thứ ba</p>
                                                                        <p className={style.selectDate}>1</p>
                                                                        <p className={style.selectMonth}>Tháng 1</p>
                                                                  </div>
                                                            </Col>
                                                            <Col className={style.dateItem}>
                                                                  <div>
                                                                        <p className={style.selectMonth}>Thứ ba</p>
                                                                        <p className={style.selectDate}>1</p>
                                                                        <p className={style.selectMonth}>Tháng 1</p>
                                                                  </div>
                                                            </Col>
                                                            <Col className={style.dateItem}>
                                                                  <div>
                                                                        <p className={style.selectMonth}>Thứ ba</p>
                                                                        <p className={style.selectDate}>1</p>
                                                                        <p className={style.selectMonth}>Tháng 1</p>
                                                                  </div>
                                                            </Col>
                                                      </Row>
                                                </Col>
                                          </Row>
                                    </div>
                                    <div>
                                          <Row className={style.calendar}>
                                                <Col span={24}>
                                                      <h3>
                                                            Chọn Lịch Chiếu
                                                      </h3>
                                                </Col>
                                                <Col span={24}>
                                                      <Row>
                                                            <Col span={24}>
                                                                  <Row gutter={[25, 15]}>
                                                                        <Col>
                                                                              <div className={style.calendarItem}>
                                                                                    <span>10:10</span>
                                                                                    <p style={{ fontSize: '12px', paddingTop: '10px' }}>40 ghế trống</p>
                                                                              </div>
                                                                        </Col>
                                                                        <Col>
                                                                              <div className={style.calendarItem}>
                                                                                    <p>10:10</p>
                                                                                    <p style={{ fontSize: '12px', paddingTop: '10px' }}>40 ghế trống</p>
                                                                              </div>
                                                                        </Col>
                                                                        <Col>
                                                                              <div className={style.calendarItem}>
                                                                                    <p>10:10</p>
                                                                                    <p style={{ fontSize: '12px', paddingTop: '10px' }}>40 ghế trống</p>

                                                                              </div>
                                                                        </Col>
                                                                        <Col>
                                                                              <div className={style.calendarItem}>
                                                                                    <p>10:10</p>
                                                                                    <p style={{ fontSize: '12px', paddingTop: '10px' }}>40 ghế trống</p>

                                                                              </div>
                                                                        </Col>
                                                                        <Col>
                                                                              <div className={style.calendarItem}>
                                                                                    <p>10:10</p>
                                                                                    <p style={{ fontSize: '12px', paddingTop: '10px' }}>40 ghế trống</p>

                                                                              </div>
                                                                        </Col>
                                                                        <Col>
                                                                              <div className={style.calendarItem}>
                                                                                    <p>10:10</p>
                                                                                    <p style={{ fontSize: '12px', paddingTop: '10px' }}>40 ghế trống</p>

                                                                              </div>
                                                                        </Col>
                                                                        <Col>
                                                                              <div className={style.calendarItem}>
                                                                                    <p>10:10</p>
                                                                                    <p style={{ fontSize: '12px', paddingTop: '10px' }}>40 ghế trống</p>

                                                                              </div>
                                                                        </Col>
                                                                        <Col>
                                                                              <div className={style.calendarItem}>
                                                                                    <p>10:10</p>
                                                                                    <p style={{ fontSize: '12px', paddingTop: '10px' }}>40 ghế trống</p>

                                                                              </div>
                                                                        </Col>
                                                                        <Col>
                                                                              <div className={style.calendarItem}>
                                                                                    <p>10:10</p>
                                                                                    <p style={{ fontSize: '12px', paddingTop: '10px' }}>40 ghế trống</p>

                                                                              </div>
                                                                        </Col>
                                                                        <Col>
                                                                              <div className={style.calendarItem}>
                                                                                    <p>10:10</p>
                                                                                    <p style={{ fontSize: '12px', paddingTop: '10px' }}>40 ghế trống</p>

                                                                              </div>
                                                                        </Col>
                                                                        <Col>
                                                                              <div className={style.calendarItem}>
                                                                                    <p>10:10</p>
                                                                                    <p style={{ fontSize: '12px', paddingTop: '10px' }}>40 ghế trống</p>

                                                                              </div>
                                                                        </Col>
                                                                  </Row>
                                                            </Col>
                                                      </Row>
                                                </Col>
                                          </Row>
                                    </div>
                              </Form>)
                        }
                        <div>
                              <Row className={style.trailerMovies}>
                                    <Col>
                                          <h3>Trailer Movies</h3>
                                    </Col>
                                    <Col span={24}>
                                          {/* <VideoIframe isPlay={true} videoLink={videoLink} title={videoTitle} /> */}
                                          <ReactPlayer
                                                title={videoTitle}
                                                controls
                                                width="100%"
                                                height='550px'
                                                loop
                                                url={videoLink}
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowFullScreen
                                          />
                                    </Col>
                              </Row>
                        </div>
                  </div>
            </div>
      )
}

export default MovieDetailScreen