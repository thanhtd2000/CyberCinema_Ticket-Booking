import React from 'react';
import { Row, Col, Typography, Tag, Breadcrumb } from 'antd';
import { AiOutlineTwitter, AiOutlineLink } from 'react-icons/ai';
import { FaFacebookF, FaLinkedinIn } from 'react-icons/fa';
import { HiTrendingUp } from 'react-icons/hi';
import { BsArrowUpRight } from 'react-icons/bs';
import Image from 'next/image';
import Link from 'next/link';
import { useRouter } from 'next/router';
import Parser from 'html-react-parser';
import 'moment-timezone';
import moment from 'moment';
import { useTranslation } from 'next-i18next';

import PostMostView from '@/components/Elements/PostMostView/PostMostView';
import SamePost from '@/components/Elements/SamePost/SamePost';
import { ELanguage } from '@/configs/interface.config';
import { queryAllPost, queryAllPostBySlug } from '@/queries/hooks/post';
import { TPost } from '@/modules/post';
import { baseParams } from '@/configs/const.config';
import { TTaxonomy } from '@/modules/taxonomy';

import style from './style.module.less';

const { Paragraph } = Typography;
export interface IListPostDetail {
  slug: string;
  listPostView: TPost[];
}
export default function PostDetail({ slug, listPostView }: IListPostDetail) {
  const router = useRouter();
  const { t } = useTranslation();
  const { data: postDetail } = queryAllPostBySlug(slug.toString(), router.locale as ELanguage);
  const taxonomyIds = postDetail?.data.taxonomies?.map((value: TTaxonomy) => value._id);
  const { data: fetchAllNewByCategory } = queryAllPost(
    { ...baseParams, limit: 3, 'taxonomyIds[]': taxonomyIds },
    router.locale as ELanguage,
  );
  return (
    <div>
      <div className='container'>
        <div className={style.detail}>
          <Row gutter={[{ xs: 0, sm: 40, md: 40, lg: 83 }, 0]}>
            <Col xs={24} sm={24} md={24} lg={17}>
              <Row>
                <Col span={24}>
                  <Breadcrumb
                    style={{ paddingBottom: '56px' }}
                    items={[
                      {
                        title: <Link href='/'>{t('home_page')}</Link>,
                      },
                      {
                        title: <Link href='/post'>{t('news')}</Link>,
                      },
                      {
                        title: postDetail?.data?.name,
                      },
                    ]}
                  />
                </Col>
                <Col span={24}>
                  <h1 className={style.mainTitle}>{postDetail?.data?.name}</h1>
                </Col>
                <Col span={24}>
                  <Row className={style.nav}>
                    <div>
                      {postDetail?.data ? (
                        postDetail?.data.taxonomies.map((item) => <Tag className={style.tag}>{item.name}</Tag>)
                      ) : (
                        <div>Loading...</div>
                      )}
                    </div>
                    <div className={style.time}>
                      <Image src='/images/Vector (19).png' width={14} height={14} alt='vector' />
                      <Paragraph className={style.timeDetail}>
                        {moment(postDetail?.createdAt)
                          .format('dddd , DD/MM/YYYY,HH:MM')
                          .replace(/(^|\s)(\w)/g, (match) => match.toUpperCase())}
                        {` (GTM  ${moment(postDetail?.createdAt).tz('Asia/Ho_Chi_Minh').format('Z')})`}
                      </Paragraph>
                    </div>
                  </Row>
                </Col>
                {postDetail?.data ? (
                  <Col className={style._content} span={24}>
                    {Parser(postDetail?.data?.content)}
                  </Col>
                ) : (
                  <div>Loading...</div>
                )}
                <Col span={24} className={style.media}>
                  <div className={style.social}>
                    <span>
                      <FaFacebookF />
                    </span>
                    <span>
                      <FaLinkedinIn />
                    </span>
                    <span>
                      <AiOutlineTwitter />
                    </span>
                    <span>
                      <AiOutlineLink />
                    </span>
                  </div>
                  <div className={style.vnexpress}>
                    <Paragraph className={style.text}>{t('news:By')} VnExpress</Paragraph>
                    <Link href='/'>
                      {t('news:Visit')} <BsArrowUpRight />
                    </Link>
                  </div>
                </Col>
                <Col span={24}>
                  <h2 className={style.titleNews}>{t('news:RelatedPosts')}</h2>
                </Col>
                <Col span={24}>
                  <Row>
                    {fetchAllNewByCategory?.data &&
                      fetchAllNewByCategory.data.map((item: TPost) => (
                        <Col span={24}>
                          <Link href={`/post/${item?.slug ? item?.slug : '/#'}`}>
                            <SamePost fetchAllNewByCategory={item} />
                          </Link>
                        </Col>
                      ))}
                  </Row>
                </Col>
              </Row>
            </Col>
            <Col xs={24} lg={7} className={style.detailRight}>
              <Row>
                <Col span={24}>
                  <h5>
                    {t('news:Most_Viewed')} <HiTrendingUp />
                  </h5>
                </Col>
                <Col span={24}>
                  <Row>
                    {listPostView.map((item, index) => (
                      <Link href={`/post/${item?.slug ? item?.slug : '/#'}`}>
                        <Col span={24}>
                          <PostMostView number={index + 1} text={item.name} />
                        </Col>
                      </Link>
                    ))}
                    <Col span={24} style={{ paddingTop: '64px' }}>
                      <Image className={style.image} src='/images/image 640.png' width={271} height={542} alt='ad' />
                    </Col>
                  </Row>
                </Col>
              </Row>
            </Col>
          </Row>
        </div>
      </div>
    </div>
  );
}
