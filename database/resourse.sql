
--
-- 資料庫： `resourse`
--

-- --------------------------------------------------------

--
-- 資料表結構 `event`
--

CREATE TABLE `event` (
  `EID` int(11) NOT NULL,
  `JID` int(11) DEFAULT NULL,
  `teacher` varchar(50) NOT NULL,
  `office` varchar(50) NOT NULL,
  `wantday` int(11) NOT NULL,
  `wanttime` int(11) NOT NULL,
  `finished` bit(1) DEFAULT b'0',
  `r_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `jinde`
--

CREATE TABLE `jinde` (
  `JID` int(11) NOT NULL,
  `RID` varchar(50) NOT NULL,
  `UID` varchar(50) NOT NULL,
  `SID` int(11) NOT NULL,
  `finished` bit(1) DEFAULT b'0',
  `access_flag` bit(1) DEFAULT b'1',
  `applytime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `reason`
--

CREATE TABLE `reason` (
  `description` varchar(50) NOT NULL,
  `RID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `student`
--

CREATE TABLE `student` (
  `SID` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `applyday1` date DEFAULT NULL,
  `applyday2` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `system_inform`
--

CREATE TABLE `system_inform` (
  `type` varchar(50) NOT NULL,
  `check_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `teacher`
--

CREATE TABLE `teacher` (
  `office` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `UID` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EID`),
  ADD UNIQUE KEY `JID` (`JID`);

--
-- 資料表索引 `jinde`
--
ALTER TABLE `jinde`
  ADD PRIMARY KEY (`JID`);

--
-- 資料表索引 `reason`
--
ALTER TABLE `reason`
  ADD UNIQUE KEY `RID` (`RID`);

--
-- 資料表索引 `student`
--
ALTER TABLE `student`
  ADD UNIQUE KEY `SID` (`SID`);

--
-- 資料表索引 `system_inform`
--
ALTER TABLE `system_inform`
  ADD UNIQUE KEY `check_date` (`check_date`);

--
-- 資料表索引 `teacher`
--
ALTER TABLE `teacher`
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `UID` (`UID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `event`
--
ALTER TABLE `event`
  MODIFY `EID` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `jinde`
--
ALTER TABLE `jinde`
  MODIFY `JID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
