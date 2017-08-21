-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-08-21 04:22:16
-- 服务器版本： 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '昵称',
  `real_name` varchar(255) DEFAULT NULL,
  `headimgurl` varchar(255) DEFAULT NULL COMMENT '头像地址',
  `age` int(11) DEFAULT '0' COMMENT '年龄',
  `country` varchar(255) DEFAULT NULL COMMENT '国家',
  `province` varchar(255) DEFAULT NULL COMMENT '省份',
  `city` varchar(255) DEFAULT NULL COMMENT '城市',
  `sex` tinyint(1) DEFAULT '0' COMMENT '性别',
  `openid` varchar(190) DEFAULT NULL,
  `language` varchar(190) DEFAULT NULL,
  `wechat_data` text,
  `created_at` int(11) DEFAULT NULL COMMENT '注册时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `email` varchar(190) DEFAULT NULL COMMENT '邮箱, 允许登录',
  `password_hash` varchar(60) DEFAULT NULL COMMENT '密码hash',
  `auth_key` varchar(32) DEFAULT NULL,
  `unconfirmed_email` varchar(190) DEFAULT NULL COMMENT '未确认的邮箱',
  `blocked_at` int(11) DEFAULT NULL COMMENT '被锁定的时间',
  `registration_ip` varchar(45) DEFAULT NULL COMMENT '注册ip',
  `flags` int(11) DEFAULT '0',
  `mobile` varchar(45) DEFAULT NULL COMMENT '手机号码, 允许登录',
  `status` smallint(6) DEFAULT '10' COMMENT '冗余扩展',
  `wechat_id` varchar(45) DEFAULT NULL COMMENT '微信ID, 用于添加好友',
  `last_login_at` int(11) DEFAULT NULL COMMENT '最后一次登录时间',
  `last_active_at` int(11) DEFAULT NULL COMMENT '最后一次活跃时间',
  `email_confirmation_token` varchar(60) DEFAULT NULL COMMENT '确认邮箱token',
  `password_reset_token` varchar(60) DEFAULT NULL COMMENT '重置密码token',
  `is_email_verified` tinyint(3) UNSIGNED DEFAULT '0' COMMENT '邮箱已确认',
  `unionid` varchar(60) DEFAULT NULL COMMENT '现在只考虑微信登录的                   union_id',
  `access_token` varchar(32) DEFAULT NULL COMMENT '用于移动端访问的TOKEN',
  `subscribe` tinyint(1) DEFAULT '0' COMMENT '是否关注服务号 0 未关注 1 已关注',
  `subscribe_time` int(11) DEFAULT '0' COMMENT '关注服务号的时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `real_name`, `headimgurl`, `age`, `country`, `province`, `city`, `sex`, `openid`, `language`, `wechat_data`, `created_at`, `updated_at`, `email`, `password_hash`, `auth_key`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `flags`, `mobile`, `status`, `wechat_id`, `last_login_at`, `last_active_at`, `email_confirmation_token`, `password_reset_token`, `is_email_verified`, `unionid`, `access_token`, `subscribe`, `subscribe_time`) VALUES
(1, 'stark.wang', NULL, 'http://wx.qlogo.cn/mmopen/uCr0XQkia65fRdRkjAArpwbYoDiad9LrMMVq1SiabjsC3EGspryE59ogR2XatPvQrVxcUTjEF2xwN1XMxNY1Qlx6Hqsue5lhQhM/0', 0, '中国', '北京', NULL, 1, 'oPs5ouLW3qg7P6CLj-jS7M1XVtSw', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7ww-ZMphcik-5ZSbkCr_QTQw', NULL, 0, 0),
(3, 'Curtain', NULL, 'http://wx.qlogo.cn/mmopen/oVMohbGiaDHYWSKm2oNJbiaCftk1KTrlg59pwYEYBXyu6ne8jyPvNJuuL45jaQw6QIK1lTekgia905cSm7VXervSd2W9kxyHicdK/0', 0, '哥斯达黎加', '', NULL, 1, 'oPs5ouCrVee_xPOf6uYLnd_WVX7I', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7wzjkexu_pATJPNMV_VBkuDE', NULL, 0, 0),
(4, '尘封的记忆', NULL, 'http://wx.qlogo.cn/mmopen/oVMohbGiaDHZ9lMnsF9t8jtY6MDmMvxqpECwicN0gAXoic0StbRpsTFkSNiaMx4T6bxuawVCageaQAGoGBRK2pQH2LFNnjLFPZjL/0', 0, '爱尔兰', '凯里', NULL, 1, 'oPs5ouF2OY8x9Tzwez-24oAfKQ0U', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7wz6oM8OZjP5uTdLVqM6G_gQ', NULL, 0, 0),
(5, '????????', NULL, 'http://wx.qlogo.cn/mmopen/oVMohbGiaDHZ9lMnsF9t8jmMib7VZ7PjpnLiaqcdKfsjTlyVv4tBEjofeicCK1sicfeWOc1AnbVhEMFmTF6dJntwP1kkK0lfVMXDN/0', 0, '中国', '北京', NULL, 1, 'oPs5ouEDYqGOmmkm6mAQoVT4UYUw', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7w7BQR6aMHQIAvxIHmcaunUU', NULL, 0, 0),
(6, '咖啡✎﹏﹏✪', NULL, 'http://wx.qlogo.cn/mmopen/xkj6T73nVsBASLjPA9iaPVibPNmw8xNL5icWxgay0szpO3M1l0ickJY2UDQ2icn50F2Rf1SJich3ANibFuYXfjJrwTwMzVMRWQ1ntl9/0', 0, '中国', '黑龙江', NULL, 1, 'oPs5ouCYpSVcLLC3amNN8IoOGU54', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7w5F9B385V4dnCC6FLR16OfY', NULL, 0, 0),
(8, '六六', NULL, 'http://wx.qlogo.cn/mmopen/oVMohbGiaDHZ9lMnsF9t8jtbn7jVGQibKeGCXIeg3Bc9Yhb3OdUGAsCjYZYtJx7fw7AywwPxDE8S3R9II389Xnk21J9l8Wibh5m/0', 0, '中国', '湖北', NULL, 2, 'oPs5ouLXrD_CxeCwDN2J2k7esamI', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7w3a7_P8xwJ_BzSf3SW8B41E', NULL, 0, 0),
(9, '看得见的现在，抓得住的眼前！', NULL, 'http://wx.qlogo.cn/mmopen/xkj6T73nVsBASLjPA9iaPV1UlKSgHqUadEg6j8UAQ0nfRDPSqibOBUXQa3uCgwOia9xWfTtpRU8qZV2IvZFMahdibp9ibUCpUZYI3/0', 0, '中国', '山西', NULL, 1, 'oPs5ouAaLx3YRAT6BSCdh7irr_Gg', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7w1QLiPk_iT5ZGc_1vENjVLA', NULL, 0, 0),
(10, '星', NULL, 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEJGrfXFcsk6FtIibWS85CWicWbdUcwlT0ia6deSH2yHVhZIZjX1v2eS1RM5adFtcoiby3fMykr5LaEFxQ/0', 0, '', '', NULL, 1, 'oPs5ouPYnJy1ZFrValYebXNbvCws', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7w2SUKqMW8osYhHOxRqTzVfw', NULL, 0, 0),
(11, 'gen', NULL, 'http://wx.qlogo.cn/mmopen/uCr0XQkia65fRdRkjAArpwVAEMukUWY2uZyAyUbgIbrhdQDqnic3s10daRH0XJ6R3PteGqJGicW3jWPSz8hVGjCwtHFtkK3j48Q/0', 0, '巴巴多斯岛', '', NULL, 1, 'oPs5ouFBCRk1UeaaqvC6gBEzfHPQ', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7wzU7KRhoaXouJ0_xJVS3sak', NULL, 0, 0),
(12, 'Arun', NULL, 'http://wx.qlogo.cn/mmopen/amOOzObpRAPq1RzvMZ5icVyzqlxficayTxSicCHcOHibiaTPUvIS4YBmAlSspuowrkTkLrxnibkaJ1gOCQIibXjibA51dEwjq97sR4kic/0', 0, '中国', '湖南', NULL, 1, 'oPs5ouCR73p3WUENoPZlvY8Fwbpo', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7w9wLBVbuzuCi4OjmvFbvj1k', NULL, 0, 0),
(14, '大雄', NULL, 'http://wx.qlogo.cn/mmopen/uCr0XQkia65fRdRkjAArpwaib16hcedSBb6XI36LGcianeBkDuRyicBqkOk6rAOhgia7EXvx0hURP7lBc51lG43Ria1aCZO1DwDVL4/0', 0, '中国', '湖北', NULL, 1, 'oPs5ouF0aA-Iz0PvSUp_Unv60z7M', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7wxg7ACUhLqbZ8wvHutWEe2k', NULL, 0, 0),
(16, '刘帅', NULL, 'http://wx.qlogo.cn/mmopen/xkj6T73nVsBASLjPA9iaPV1jROoAMw6gzIHibJebg2PqmaBZny5A49HBJUlXqe4hUAug7NJcj7LDyCOf1ib1m6v02yfJB2mGOfZ/0', 0, '中国', '黑龙江', NULL, 1, 'oPs5ouKce5JL-ir_5pW5LFOSVKog', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7wwD-mOsSfMzphUsbUmfFCz4', NULL, 0, 0),
(18, '如果世界还记得你', NULL, 'http://wx.qlogo.cn/mmopen/oVMohbGiaDHZ9lMnsF9t8jg6w7DHjGDnicqn2icpQMtXJicJBk53PDR4jMe6RmRdCCgVBOLLiaeG4so9AvOVAe5bp1oeTqxyow5k3/0', 0, '中国', '山西', NULL, 1, 'oPs5ouFF8yVJEJG9I7DmpjKzwSy8', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7w8s7F0NGrfxAHVPCSe6JAfc', NULL, 0, 0),
(21, '瑕不掩瑜，', NULL, 'http://wx.qlogo.cn/mmopen/kaphyB6oHwEMAEC3ApoyjdNXeH316OHA2P418IbEvTy7tDLBmd5iaQod4yJPhJDZ701V7fKwNs4yXOehXTCUgg7vRRqJv1tll/0', 0, '中国', '湖南', NULL, 1, 'oPs5ouLlLLOurGY5oQ10EvrZQeFg', 'zh_CN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 10, NULL, NULL, NULL, NULL, NULL, 0, 'o28P7w_BV4AckXFGOmnPSVDKqMnk', NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_email` (`email`),
  ADD UNIQUE KEY `mobile_UNIQUE` (`mobile`),
  ADD UNIQUE KEY `uniq_unionid` (`unionid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
