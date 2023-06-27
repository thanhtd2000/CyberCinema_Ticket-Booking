import React, { useState } from 'react'
import { Col, Row, Typography, Tag, Button, Space, Modal } from 'antd'
const { Title } = Typography
import { AiFillPlayCircle } from 'react-icons/ai';
import Image from 'next/image'
import style from './style.module.less'
import VideoIframe from '../VideoTrailer';
import { TMovies } from '@/modules/movies';
import { TCategory } from '@/modules/category';
import Link from 'next/link';
import dayjs from 'dayjs';
interface ItemMovies {
      movies: TMovies;
}
function MovieItem({ movies }: ItemMovies) {
      const [isModalOpen, setIsModalOpen] = useState(false);
      const [isPlay, setIsPlay] = useState(true);
      const videoLink = movies?.trailer
      const videoTitle = "[전인혁작곡] 야다(Yada) - 약속 (2019 ver)";
      const showModal = () => {
            setIsModalOpen(true);
            setIsPlay(true)
      };

      const handleOk = () => {
            setIsModalOpen(false);
            setIsPlay(false)
      };

      const handleCancel = () => {
            setIsModalOpen(false);
            setIsPlay(false)
      };

      return (
            <Col xs={24} sm={12} md={8} lg={8} xl={6} className={style.movieItem}>
                  <Row gutter={[{ xs: 24 }, 10]}>
                        <Col xs={12} sm={24} md={24} lg={24} xl={24} className={style.movieImage}>
                              <Image src={movies?.image} width={227} height={360} alt='' />
                              <span onClick={showModal} className={style.playTrailer}><AiFillPlayCircle></AiFillPlayCircle></span>
                              <Modal title={movies?.name} footer={false} width={1000} open={isModalOpen} onOk={handleOk} onCancel={handleCancel}>
                                    <VideoIframe isPlay={isPlay} videoLink={videoLink} title={videoTitle} />
                              </Modal>
                              <Space className={style.movieHot}>
                                    {movies?.year_old ? (<Tag>C{movies?.year_old}</Tag>) : ''}
                                    {movies?.isHot === 1 ? (<Tag>Hot</Tag>) : ('')}
                              </Space>
                        </Col>
                        <Col xs={12} sm={24} md={24} lg={24} xl={24}>
                              <Row>
                                    <Col span={24}>
                                          <Link href={`movies/${movies?.slug}`}>
                                                <Title level={4}>{movies?.name}</Title>
                                          </Link>
                                    </Col>
                                    <Col span={24} className={style.movieType}>
                                          <span style={{ color: '#fff' }}>Thể loại: </span>
                                          {
                                                movies?.category.map((i: TCategory) => (<Tag className={style.tag}>{i.name}</Tag>))
                                          }
                                    </Col>
                                    <Col span={24} className={style.movieType}>
                                          <span style={{ color: '#fff' }}>Thời lượng: </span>
                                          <Tag className={style.tag}>{movies?.time}</Tag>
                                    </Col>
                                    <Col span={24}>
                                          {
                                                dayjs(movies?.date).isAfter(dayjs()) === true ? (<Button disabled>Release Soon ...</Button>) : (<Link href={`movies/${movies?.slug}`}>
                                                      <Button>Mua vé</Button>
                                                </Link>)
                                          }
                                    </Col>
                              </Row>
                        </Col>
                  </Row>
            </Col>
      )
}

export default MovieItem