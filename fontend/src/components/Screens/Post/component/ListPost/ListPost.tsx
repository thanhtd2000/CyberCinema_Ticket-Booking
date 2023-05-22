/* eslint-disable no-nested-ternary */
/* eslint-disable react/button-has-type */
/* eslint-disable jsx-a11y/click-events-have-key-events */
/* eslint-disable jsx-a11y/no-noninteractive-element-interactions */
import React, { useMemo, useState } from 'react';
import { Row, Col, Typography, Breadcrumb, Input, Menu, Select, Space, Button } from 'antd';
import Image from 'next/image';
import Link from 'next/link';
import type { MenuProps } from 'antd';
import { TfiPrinter } from 'react-icons/tfi';
import { useRouter } from 'next/router';
import { useTranslation } from 'next-i18next';

import PaginationCustom from '@/components/Widgets/PaginationCustom/Pagination';
import { handleFilter } from '@/libs/const';
import Post from '@/components/Elements/ListPost/Post';
import ListHotNews from '@/components/Elements/ListHotNews/ListHotNews';
import HotNews from '@/components/Elements/HotNews/HotNews';
import { queryAllPost, queryAllPostScroll } from '@/queries/hooks/post';
import { ELanguage, EOrderBy } from '@/configs/interface.config';
import { baseParams } from '@/configs/const.config';
import { queryAllTaxonomy } from '@/queries/hooks/taxonomy';
import { TQueryPost } from '@/modules/post';

import style from './style.module.less';

const { Search } = Input;
const { Title, Paragraph } = Typography;
export default function ListPost() {
  const { t } = useTranslation();
  const [current, setCurrent] = useState('0');
  const [params, setParams] = useState<TQueryPost>();
  const router = useRouter();
  const { data: listPost } = queryAllPost({ ...baseParams, limit: 6, isHot: 1 }, router.locale as ELanguage);
  const {
    data: listPostScroll,
    fetchNextPage: fetchNextPageCity,
    hasNextPage: hasNextPageCity,
    isLoading: isLoadingCity,
  } = queryAllPostScroll({ ...baseParams, limit: 1 }, router.locale as ELanguage);
  console.log(listPostScroll);
  const hotNews = listPost?.data.slice(1);
  const { data: listPostSearch } = queryAllPost(
    { ...baseParams, limit: 6, ...params, isHot: 0 },
    router.locale as ELanguage,
  );
  const { data: listTaxonomy } = queryAllTaxonomy({ ...baseParams, limit: 6 }, router.locale as ELanguage);
  const handleSortPost = (id: string) => {
    if (id) {
      setParams({ ...params, 'taxonomyIds[]': id });
    } else {
      setParams({ ...params });
    }
  };
  const handleTakeAllPost = () => {
    setParams({ ...baseParams });
  };
  const onSearch = (value: string) => {
    setParams({ ...params, s: value });
  };
  const handleChange = (value: string) => {
    setParams({
      ...params,
      orderBy: handleFilter(value).orderBy as EOrderBy,
      order: handleFilter(value).order,
    });
  };
  const taxonomy = useMemo(() => listTaxonomy?.data, [listTaxonomy]);
  const item = taxonomy?.map((v, k) => ({
    // eslint-disable-next-line jsx-a11y/click-events-have-key-events
    label: <li onClick={() => handleSortPost(v._id)}>{v.name}</li>,
    key: k + 1,
  }));
  item?.unshift({ label: <li onClick={handleTakeAllPost}>{t('news:General_News')}</li>, key: 0 });
  const onClick: MenuProps['onClick'] = (e) => {
    setCurrent(e.key);
  };
  return (
    <div className='Post'>
      <div className='container'>
        <div className={style.ListPost}>
          <Row>
            <Col span={24} style={{ paddingBottom: '56px' }}>
              <Breadcrumb
                items={[
                  {
                    title: <Link href='/'>{t('home_page')}</Link>,
                  },
                  {
                    title: `${t('common:more_news')}`,
                  },
                ]}
              />
            </Col>
            <Col span={24}>
              <Row gutter={[0, { xs: 40, sm: 30, md: 50, lg: 80 }]}>
                <Col span={24}>{listPost?.data && <HotNews listPost={listPost?.data} />}</Col>
                <Col span={24}>
                  <Row gutter={[{ xs: 0, sm: 40, md: 40, lg: 83 }, 0]}>
                    {listPostScroll?.pages.map((item) => (
                      <ListHotNews listPost={item.data[0]} />
                    ))}
                  </Row>
                </Col>
                <Col span={24}>
                  <button onClick={() => fetchNextPageCity()} disabled={!hasNextPageCity || isLoadingCity}>
                    {isLoadingCity ? 'Loading more...' : hasNextPageCity ? 'Load More' : 'Nothing more to load'}
                  </button>
                </Col>
              </Row>
            </Col>
          </Row>
        </div>
      </div>
      <div className='container'>
        <div className={style.filterPost}>
          <Row gutter={[{ xs: 0, sm: 30, md: 40, lg: 40, xl: 83 }, 0]}>
            <Col xs={24} sm={24} md={7} lg={7}>
              <Row>
                <Col span={24}>
                  <Search
                    className={style.searchMenu}
                    onSearch={onSearch}
                    placeholder='Tìm kiếm bài viết'
                    enterButton
                    allowClear
                  />
                </Col>
                <Col span={24}>
                  <Title level={5}>{t('Category')}</Title>
                  <Menu
                    style={{ backgroundColor: 'rgb(187 187 187 / 0%)' }}
                    onClick={onClick}
                    selectedKeys={[current]}
                    items={item}
                  />
                </Col>
                <Col span={24} className={style.ad}>
                  <Image src='/images/chinnghekv-skyscrapper 1.png' width={271} height={542} alt='ad' />
                </Col>
              </Row>
            </Col>
            <Col xs={24} sm={24} md={17} lg={17}>
              <Row>
                <Col span={24} className={style.list}>
                  <Title level={3}>{t('news:General_News')}</Title>
                  <Space className={style.sortPost}>
                    <Paragraph
                      style={{ marginBottom: '0', fontSize: '12px', fontFamily: 'SF UI  Text', color: '#595959' }}
                    >
                      {t('news:Sort_by')} :
                    </Paragraph>
                    <Select
                      value={params?.order === 'ASC' ? `-${params?.orderBy}` : `${params?.orderBy || 'createdAt'}`}
                      className={style.sort}
                      defaultValue='createdAt'
                      style={{ width: 90 }}
                      onChange={handleChange}
                      options={[
                        { value: 'createdAt', label: `${t('news:Latest')}` },
                        { value: '-createdAt', label: `${t('news:Oldest')}` },
                        { value: '-name', label: 'A-Z' },
                        { value: 'name', label: 'Z-A' },
                        { value: 'viewer', label: `${t('news:View')}` },
                      ]}
                    />
                  </Space>
                </Col>
                {listPostSearch?.data && listPostSearch?.data.length > 0 ? (
                  listPostSearch?.data.map((item) => (
                    <Col span={24}>
                      <Link href={`/post/${item?.slug ? item?.slug : '/#'}`}>
                        <Post listPostSearch={item} />
                      </Link>
                    </Col>
                  ))
                ) : (
                  <Col span={24} style={{ display: 'flex', justifyContent: 'center', paddingTop: '50px' }}>
                    <div>
                      <TfiPrinter style={{ fontSize: '60px', opacity: '0.5' }} />
                    </div>
                  </Col>
                )}
                {listPostSearch?.data && listPostSearch?.data.length > 7 ? (
                  <Col span={24} style={{ display: 'flex', justifyContent: 'flex-end', paddingTop: '15px' }}>
                    <PaginationCustom min={1} max={listPostSearch?.data.length} />
                  </Col>
                ) : (
                  ''
                )}
              </Row>
            </Col>
          </Row>
        </div>
      </div>
    </div>
  );
}
