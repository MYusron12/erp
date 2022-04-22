-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2020 at 05:55 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kas_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE `bagian` (
  `idbagian` int(11) NOT NULL,
  `kode_bagian` varchar(128) NOT NULL,
  `nama_bagian` varchar(128) NOT NULL,
  `kepala_bagian` varchar(128) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`idbagian`, `kode_bagian`, `nama_bagian`, `kepala_bagian`, `id_user`) VALUES
(1, 'BD', 'Bussiness Development', 'Bernadet Marissa', 0),
(2, 'CS', 'CS', 'E. Ariyanto', 0),
(5, 'GA', 'General Affair', 'E. Ariyanto', 0),
(6, 'HRD', 'Human Resource Department', 'E. Ariayanto', 0),
(7, 'FA', 'Finance Accounting', 'Iwan Rusli', 0);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_categori` int(11) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` decimal(19,2) NOT NULL,
  `stok` int(100) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_categori`, `kode_barang`, `nama_barang`, `harga`, `stok`, `id_satuan`, `status`, `id_user`) VALUES
(1, 2, 'B000001', 'Baju1', '1500.25', 9, 1, 1, 16),
(4, 2, 'B000002', 'kertas', '2000.00', 0, 4, 0, 16);

-- --------------------------------------------------------

--
-- Table structure for table `bisnis`
--

CREATE TABLE `bisnis` (
  `idbisnis` int(11) NOT NULL,
  `kode_bisnis` varchar(128) NOT NULL,
  `nama_bisnis` varchar(128) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bisnis`
--

INSERT INTO `bisnis` (`idbisnis`, `kode_bisnis`, `nama_bisnis`, `id_user`) VALUES
(1, 'BNS-0001', 'MDS', 0),
(2, 'BNS-0002', 'MNL', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bskantorpusat`
--

CREATE TABLE `bskantorpusat` (
  `idbskantorpusat` int(11) NOT NULL,
  `nobs` varchar(128) NOT NULL,
  `nokasbank` varchar(128) NOT NULL,
  `tanggal` date NOT NULL,
  `pemohon` varchar(128) NOT NULL,
  `jumlah` float(10,2) NOT NULL,
  `nkasbank` float(10,2) NOT NULL,
  `mata_uang` varchar(128) NOT NULL,
  `keperluan` varchar(128) NOT NULL,
  `idbagian` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `ec` int(11) NOT NULL,
  `na` int(11) NOT NULL,
  `idbisnis` int(11) NOT NULL,
  `tglperkiraanrealisasi` date NOT NULL,
  `catatan` varchar(128) NOT NULL,
  `status` int(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hub` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bskantorpusat`
--

INSERT INTO `bskantorpusat` (`idbskantorpusat`, `nobs`, `nokasbank`, `tanggal`, `pemohon`, `jumlah`, `nkasbank`, `mata_uang`, `keperluan`, `idbagian`, `id_department`, `ec`, `na`, `idbisnis`, `tglperkiraanrealisasi`, `catatan`, `status`, `id_user`, `hub`) VALUES
(29, 'BSP-00000001', '', '2020-04-20', 'asdasd', 2000000.00, 0.00, 'IDR', 'asdasd', 1, 4, 1, 1, 1, '2020-04-20', 'sDASD', 1, 13, '4');

-- --------------------------------------------------------

--
-- Table structure for table `categori`
--

CREATE TABLE `categori` (
  `id_categori` int(11) NOT NULL,
  `nama_categori` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categori`
--

INSERT INTO `categori` (`id_categori`, `nama_categori`, `id_user`) VALUES
(2, 'dd', 16);

-- --------------------------------------------------------

--
-- Table structure for table `coa_ec`
--

CREATE TABLE `coa_ec` (
  `id_coa_ec` int(11) NOT NULL,
  `account` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coa_ec`
--

INSERT INTO `coa_ec` (`id_coa_ec`, `account`, `nama`, `id_user`) VALUES
(1, '0', 'NERACA', 1),
(2, '10', 'Property', 0),
(3, '11', 'Property level I-III', 0),
(4, '13', 'Property level V', 0),
(5, '20', 'Equipment', 0),
(6, '100', 'Store Controll', 0),
(7, '110', 'Director', 0),
(8, '111', 'BOC (Board Of Commissioner)', 0),
(9, '120', 'Bpk. Hari Darmawan', 0),
(10, '130', 'Store operation', 0),
(11, '131', 'Store Controll Mds', 0),
(12, '132', 'Store Operation level IV', 0),
(13, '133', 'Property & leasing', 0),
(14, '140', 'Audit', 0),
(15, '150', 'Interior Planning', 0),
(16, '151', 'OVS', 0),
(17, '152', 'Adidas', 0),
(18, '153', 'Disney', 0),
(19, '154', 'Under Urmor', 0),
(20, '155', 'Home & Co', 0),
(21, '156', '361', 0),
(22, '157', 'DP Shoes', 0),
(23, '160', 'Loss Prevention', 0),
(24, '161', 'Real Estate Dept', 0),
(25, '162', 'Risk Management Mds', 0),
(26, '163', 'Fire Prevention', 0),
(27, '170', 'Finance Management', 0),
(28, '171', 'Finance Management level I-III', 0),
(29, '180', 'Joint Promotion', 0),
(30, '190', 'Store Concep & Plan', 0),
(31, '1', 'Bpk. AH Komala Termasuk P\' Pur', 0),
(32, '1', 'Store Design', 0),
(33, '1', 'Project Tender', 0),
(34, '1', 'Store Project', 0),
(35, '1', 'Building Development', 0),
(36, '1', 'Treasury & Insurance', 0),
(37, '1', 'Matahari Card', 0),
(38, '1', 'Public Relation', 0),
(39, '1', 'Corporate Compliance', 0),
(40, '1', 'Twinning', 0),
(41, '1', 'Manajemen MDS', 0),
(42, '1', 'Budget', 0),
(43, '1', 'Capex Controller', 0),
(44, '1', 'Bisnis Sistem & Prosedur', 0),
(45, '1', 'SO Director MDS', 0),
(46, '210', 'Control Management', 0),
(47, '230', 'Account Payable', 0),
(48, '250', 'Cash Office', 0),
(49, '251', 'Cash Office I - III', 0),
(50, '252', 'Cash Office IV', 0),
(51, '260', 'Inventory Control', 0),
(52, '263', 'Inventory Control level V', 0),
(53, '270', 'General Ledger', 0),
(54, '280', 'Legal', 0),
(55, '290', 'Tax', 0),
(56, '2', 'Investor Relation', 0),
(57, '2', 'Developer Relation', 0),
(58, '2', 'Asset Maintenance & Procurement', 0),
(59, '310', 'Management MIS', 0),
(60, '320', 'E D P', 0),
(61, '330', 'System', 0),
(62, '331', 'System level I-III', 0),
(63, '340', 'Programming', 0),
(64, '350', 'Help Desk', 0),
(65, '360', 'Operation Support', 0),
(66, '370', 'Production Studio', 0),
(67, '380', 'Bisnis Development', 0),
(68, '400', 'ex 40', 0),
(69, '410', 'Sales Promotion Management', 0),
(70, '411', 'Sales Promotion Management level I', 0),
(71, '420', 'Advertising', 0),
(72, '430', 'MD Show', 0),
(73, '440', 'Visual', 0),
(74, '450', 'MCC  HO', 0),
(75, '460', 'Sign Shop  HO', 0),
(76, '500', 'ex 50', 0),
(77, '510', 'Service & Operation (Purch.)', 0),
(78, '520', 'Management Purchasing Mds', 0),
(79, '530', 'Security', 0),
(80, '540', 'Service & Operation ( GA )', 0),
(81, '550', 'Telephone', 0),
(82, '560', 'Utilities', 0),
(83, '561', 'Utilities level I-III', 0),
(84, '563', 'Utilities level V', 0),
(85, '570', 'Housekeeping', 0),
(86, '580', 'Maintenance & Repair', 0),
(87, '582', 'Maintenance & Repair level IV', 0),
(88, '583', 'Maintenance & Repair level V', 0),
(89, '590', 'Maintenance Dept.', 0),
(90, '600', 'ex 60', 0),
(91, '610', 'Personnel Management', 0),
(92, '611', 'HRD PR', 0),
(93, '620', 'Recruitment', 0),
(94, '630', 'Personnel SO', 0),
(95, '640', 'Training', 0),
(96, '641', 'Training level I-III', 0),
(97, '650', 'Industrial Relation', 0),
(98, '660', 'Fringe Benefit', 0),
(99, '680', 'Benefit & Compensation', 0),
(100, '690', 'Organization Develop HRD', 0),
(101, '691', 'Performance Management', 0),
(102, '710', 'DC Management', 0),
(103, '720', 'Receiving Checking', 0),
(104, '721', 'Expedition', 0),
(105, '730', 'Reserve Stock Storage', 0),
(106, '750', 'Shuttle Service', 0),
(107, '751', 'Shuttle Service level I-III', 0),
(108, '752', 'Shuttle Service level IV', 0),
(109, '760', 'Business Development Dept', 0),
(110, '764', 'Direct Opex CV & MNL', 0),
(111, '765', 'COGS MNL', 0),
(112, '766', 'OPEX MNL', 0),
(113, '767', 'COGS Halim', 0),
(114, '768', 'Opex Halim', 0),
(115, '770', 'Package', 0),
(116, '810', 'Selling Supervisor', 0),
(117, '820', 'Pramuniaga', 0),
(118, '821', 'Pramuniaga BA', 0),
(119, '822', 'Pramuniaga Non Matahari', 0),
(120, '82', 'Produce', 0),
(121, '840', 'Customer Service', 0),
(122, '850', 'Kasir', 0),
(123, '851', 'Kasir level I-III', 0),
(124, '852', 'Kasir level IV', 0),
(125, '860', 'ex 86', 0),
(126, '900', 'Field MD Management', 0),
(127, '910', 'GMM  MD DP/PL', 0),
(128, '920', 'GM MD DP/PL-TM Ladies,Shoes,Home &', 0),
(129, '930', 'Shoes', 0),
(130, '931', 'MD Control level I-III', 0),
(131, '940', 'MD HOME', 0),
(132, '950', 'PDS', 0),
(133, '952', 'Category & Space Management', 0),
(134, '960', 'DGMM ( A1, A4, A5 ) Henkie S', 0),
(135, '970', 'DGMM ( A3 ) Margareth', 0),
(136, '980', 'GM MD DP/PL-JC (Mens, Youth Boys,', 0),
(137, '990', 'Supplier Relation', 0),
(138, '9', 'Cosmetic', 0),
(139, '9', 'Junior level I-III', 0),
(140, '9', 'Junior level IV', 0),
(141, '9', 'Missy', 0),
(142, '9', 'MD Planning & Controller', 0),
(143, '9', 'MD DUM', 0),
(144, '9', 'MD Hand Bag', 0),
(145, '9', 'Casual', 0),
(146, '9', 'MD Ecommerce', 0),
(147, '9', 'MD Ecom Production Center', 0),
(148, '9', 'Ladies Shoes & Bag', 0),
(149, '9', 'Cosmetic & Accesories', 0),
(150, '9', 'Housewares', 0),
(151, '9', 'Infant', 0),
(152, '9', 'Up Youth Boys', 0),
(153, '9', 'Up Youth Girls', 0),
(154, '9', 'Intimate & Bag', 0),
(155, '9', 'MD Control', 0),
(156, '0', 'Communication 550-559', 0),
(157, '0', 'CEK BUDGET MDS & CORP', 0),
(158, '0', 'Expense For Report MR', 0),
(159, '0', 'EC DP/PL HO & Branch', 0),
(160, '0', 'EC DP/PL Store', 0),
(161, '0', 'EC-Direct Purchase HO', 0),
(162, '0', 'EC-Direct Purchase STORE', 0),
(163, '0', 'HRD (61-65,68) Parent Account', 0),
(164, '0', 'Twinning', 0),
(165, '0', 'Account IT', 0),
(166, '0', 'MIS PARENT 31-35 & 55', 0),
(167, '0', 'ex pra op p & l 2', 0),
(168, '0', 'Pre Op. Cosmetic', 0),
(169, '0', 'Pre Opr MCC', 0),
(170, '0', 'Pre Ops Procurement', 0),
(171, '0', 'Pre Ops HRD Recruitment', 0),
(172, '0', 'Pre Ops - MIS', 0),
(173, '0', 'Pre Ops - Loss Prevention', 0),
(174, '0', 'Pre Ops- Marketing', 0),
(175, '0', 'ex pra op p & l 15', 0),
(176, '0', 'Pre Ops - Risk Mgt', 0),
(177, '0', 'Non Pre Ops', 0),
(178, '0', 'Pre Ops Store Devlp - Projct', 0),
(179, '0', 'Pre Ops - Store Operation', 0),
(180, '0', 'Pre Ops Visual', 0),
(181, '0', 'Sales Expense HO & Branch', 0),
(182, '0', 'Sales Expense Store', 0),
(183, '0', 'EC HO Space Expense', 0),
(184, '0', 'EC Store Space Expense', 0),
(185, '0', 'EXPENSE FINANCE - ACCOUNTING', 0),
(186, '0', 'EXPENSE HRD', 0),
(187, '0', 'IT EXPENSE (330 & 370)', 0),
(188, '0', 'OTHERS HO EXPENSE', 0),
(189, '0', 'Corp F & A (1A,1G,21)', 0),
(190, '0', 'Corp PROP (1B,1D,1F,1J & 1R)', 0),
(191, '0', 'Corp Pr/IR (1I,37 & 1C)', 0),
(192, '0', 'Corp IT (32 & 55)', 0),
(193, '0', 'Corp GA  (53-54,56-57,58)', 0),
(194, '0', 'Corp OTH (00,01 & 02)', 0),
(195, '0', 'Corp PROP AMT (1S,2B,2C,2D)', 0),
(196, '0', 'Corporate (32,51,53,54,55,56,57,58', 0),
(197, '0', 'Corp HRD  (66,64,61)', 0),
(198, '0', 'Corporate - PARENTS To BGT', 0),
(199, '0', 'New. EC Corporate Per 2006', 0),
(200, '0', 'Corporate - PARENTS', 0),
(201, '0', '2C1 - 2C8 - PARENTS Property', 0),
(202, '0', '2C5-2C8 - PARENTS Operating', 0),
(203, '0', 'IT PARENT(31,33,34,35,37)', 0),
(204, '0', 'MIS IT PARENT (31-35 & 55)', 0),
(205, '0', 'Expense Listrik', 0),
(206, '0', 'EXP inc. PRE OPERATING', 0),
(207, '0', 'Promotion + 1H Parents', 0),
(208, '0', 'EC EXC. 44', 0),
(209, '0', 'EC EXC. 46', 0),
(228, '555', 'tes', 1),
(229, '000', 'tes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coa_na`
--

CREATE TABLE `coa_na` (
  `id_coa_na` int(11) NOT NULL,
  `account` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coa_na`
--

INSERT INTO `coa_na` (`id_coa_na`, `account`, `nama`, `id_user`) VALUES
(1, '111', 'Gaji Pokok', 0),
(2, '112', 'Lembur', 0),
(3, '113', 'Transport', 0),
(4, '114', 'Pph 21', 0),
(5, '115', 'Thr Bonus', 0),
(6, '116', 'Incentive Sales Target', 0),
(7, '117', 'Incentive Fire Prevention', 0),
(8, '118', 'Incentive Shrinkage', 0),
(9, '119', 'Incentive Damage', 0),
(10, '11', 'Incentive Magang', 0),
(11, '11', 'Insentif Operational Toko', 0),
(12, '11', 'Incentive Customer Service', 0),
(13, '11', 'Cadangan Incentive', 0),
(14, '11', 'Incentive Open Intern/Extern', 0),
(15, '11', 'Karyawan Kontrak Harian', 0),
(16, '11', 'Karyawan Peak Season', 0),
(17, '11', 'Karyawan kontrak', 0),
(18, '181', 'Pesangon Kep. 150', 0),
(19, '191', 'Pesangon', 0),
(20, '194', 'PPh Pesangon', 0),
(21, '310', 'Promosi', 0),
(22, '311', 'Booklet & Leaflet', 0),
(23, '312', 'Iklan Koran Dan Majalah', 0),
(24, '313', 'Iklan TV Dan Radio', 0),
(25, '314', 'Iklan Lainnya', 0),
(26, '320', 'Insentif MCC', 0),
(27, '322', 'Point MCC', 0),
(28, '330', 'Instore Program', 0),
(29, '340', 'Sponsorship', 0),
(30, '341', 'Donation IR', 0),
(31, '370', 'Pendapatan MCC', 0),
(32, '371', 'Pendapatan MCC excl.POS', 0),
(33, '380', 'Incentive Sales Target', 0),
(34, '410', 'Pajak PBB', 0),
(35, '411', 'Retribusi & Pajak Lainnya', 0),
(36, '412', 'Pajak Media', 0),
(37, '413', 'Pajak STNK & Kir', 0),
(38, '610', 'Perlengkapan Stock Room', 0),
(39, '611', 'Materai', 0),
(40, '612', 'Perlengkapan Lain-Lain', 0),
(41, '613', 'Gas LPG', 0),
(42, '617', 'Biaya Materai', 0),
(43, '619', 'Rak & Hanger', 0),
(44, '620', 'BBM, Tol, Parkir', 0),
(45, '621', 'Suku Cadang Kendaraan', 0),
(46, '630', 'Bola Lampu', 0),
(47, '640', 'Seragam', 0),
(48, '650', 'Solar untuk Genset', 0),
(49, '651', 'Air PAM', 0),
(50, '660', 'Air Minum', 0),
(51, '661', 'Rekreasi, Kost & Olahraga', 0),
(52, '662', 'Stock Opname', 0),
(53, '663', 'Snack Buka Puasa', 0),
(54, '670', 'Listrik', 0),
(55, '671', 'Cadangan Listrik', 0),
(56, '672', 'Listrik (Synergy)', 0),
(57, '680', 'Kantong Plastik', 0),
(58, '686', 'Label Harga', 0),
(59, '687', 'Label Harga Dari Ho', 0),
(60, '690', 'Obat', 0),
(61, '691', 'Kebijaksanaan', 0),
(62, '692', 'Ikatan Karyawan Matahari (IKM)', 0),
(63, '693', 'Biaya Koperasi', 0),
(64, '701', 'Pembelian Jasa Lain Lain SO Pr', 0),
(65, '710', 'Pembelian Jasa', 0),
(66, '711', 'Cetak Kupon & Voucher', 0),
(67, '712', 'Service & Sewa Kendaraan', 0),
(68, '713', 'Jasa ASF', 0),
(69, '714', 'Biaya Penanggulangan Kasus', 0),
(70, '716', 'JASA QUALITY CONTROL MD - MDS', 0),
(71, '717', 'Jasa kirim Paket/Dokumen', 0),
(72, '720', 'Service Fujitsu,Sun,UPS & Mode', 0),
(73, '721', 'Koordinasi meeting', 0),
(74, '730', 'Pickup Service', 0),
(75, '731', 'Diskon Kupon Belanja', 0),
(76, '740', 'Seminar & Training', 0),
(77, '741', 'Jasa Pelatih Training Internal', 0),
(78, '742', 'Jasa Pelatih Training External', 0),
(79, '750', 'Jasa Ekspedisi', 0),
(80, '752', 'External Transportation', 0),
(81, '760', 'Management Fee PT Sahara', 0),
(82, '761', 'Jasa Royalty', 0),
(83, '770', 'Karyawan Outsourcing', 0),
(84, '780', 'Biaya Transfer LLG & Adm Bank', 0),
(85, '790', 'Biaya Credit Card', 0),
(86, '791', 'Pendapatan Tunai BCA', 0),
(87, '810', 'Lain-Lain', 0),
(88, '811', 'Parisian Charges', 0),
(89, '812', 'Loss of Closed Store', 0),
(90, '813', 'By. DC Penalty keterlambatan', 0),
(91, '814', 'By. DC Klaim Ganti Rugi', 0),
(92, '815', 'Write off/Other Expense DC', 0),
(93, '820', 'Perjamuan', 0),
(94, '830', 'Sumbangan', 0),
(95, '840', 'Biaya Executive', 0),
(96, '860', 'China Development Expense', 0),
(97, '901', 'Pembelian Jasa lain lain SO Pr', 0),
(98, '910', 'P. D. Dalam Kota', 0),
(99, '911', 'P. D. Luar Kota', 0),
(100, '912', 'Akomodasi Luar Kota', 0),
(101, '913', 'Lain-Lain P.D.', 0),
(102, '920', 'Perjalanan dinas- Raker', 0),
(103, '960', 'P.D. Luar Negeri', 0),
(104, '1010', 'Komunikasi', 0),
(105, '1011', 'Accrued  Komunikasi', 0),
(106, '1012', 'Komunikasi Hand Phone', 0),
(107, '1013', 'Komunikasi-Facsimile', 0),
(108, '1014', 'Komunikasi-Direct Line', 0),
(109, '1015', 'Komunikasi-Modem', 0),
(110, '1016', 'Komunikasi-PABX', 0),
(111, '1017', 'Komunikasi-Pager & Handy Talky', 0),
(112, '1018', 'Komunikasi-VSAT', 0),
(113, '1020', 'Komunikasi-Leased Line', 0),
(114, '1022', 'Internet', 0),
(115, '1023', 'Komunikasi-Lain Lain', 0),
(116, '1024', 'VOUCHER HP', 0),
(117, '1210', 'Asuransi Jiwa', 0),
(118, '1211', 'Asuransi Medicare', 0),
(119, '1212', 'Jaminan Pemeliharaan Kesehatan', 0),
(120, '1213', 'Jaminan Hari Tua 3.7%', 0),
(121, '1214', 'Selisih JKK, JKM & JHT 2%', 0),
(122, '1215', 'Selisih JHT 3.7%', 0),
(123, '1216', 'Premi BPJS Kes (Perusahaan)', 0),
(124, '1217', 'JP Perusahaan', 0),
(125, '1220', 'Asuransi Bangunan & Peralatan', 0),
(126, '1230', 'Asuransi Barang Dagangan', 0),
(127, '1250', 'Asuransi Kendaraan', 0),
(128, '1290', 'Asuransi Lainnya', 0),
(129, '1310', 'Penyusutan Instalasi Ac & Esca', 0),
(130, '1311', 'Penyusutan Instalasi Listrik', 0),
(131, '1312', 'Penyusutan Instalasi Telepon', 0),
(132, '1320', 'Penyusutan Peralatan Kantor', 0),
(133, '1321', 'Penyusutan Peralatan Fixtures', 0),
(134, '1322', 'Penyusutan Peralatan Studio', 0),
(135, '1323', 'Penyusutan Peralatan Games Cen', 0),
(136, '1324', 'Penyusutan Peralatan Komunikas', 0),
(137, '1325', 'Penyusutan Peralatan Mini Komp', 0),
(138, '1326', 'Penyusutan Peralatan Visual', 0),
(139, '1350', 'Penyusutan Kendaraan', 0),
(140, '1360', 'Penyusutan Bangunan', 0),
(141, '1370', 'Penyusutan Renovasi', 0),
(142, '1380', 'Penyusutan Software', 0),
(143, '1410', 'Konsultan', 0),
(144, '1412', 'Akomodasi Konsultan', 0),
(145, '1413', 'Fee Notaris', 0),
(146, '1414', 'Fee SGV', 0),
(147, '1416', 'Fee Bej , Bes & Asosiasi Emite', 0),
(148, '1417', 'R.U.P.S', 0),
(149, '1418', 'Fee Komisaris', 0),
(150, '1420', 'Lain-lain Konsultan', 0),
(151, '1610', 'Sewa Lain-lain', 0),
(152, '1710', 'Sewa Peralatan', 0),
(153, '1810', 'Maintenance & Repair', 0),
(154, '1820', 'Maintenance & Repair Rutin', 0),
(155, '1830', 'Alokasi biaya IT Corporate', 0),
(156, '1890', 'Perawatan Kendaraan', 0),
(157, '2010', 'Sewa Property', 0),
(158, '2011', 'Expired U.M. Sewa', 0),
(159, '2012', 'Sewa Gudang', 0),
(160, '2020', 'Sewa Billboard', 0),
(161, '2030', 'Service Charge', 0),
(162, '2031', 'Exp. Service Charge', 0),
(163, '3110', 'Kas Operasi', 0),
(164, '3111', 'Kas Selain Penjualan', 0),
(165, '3112', 'Kas Coin Centre Operation', 0),
(166, '3113', 'Kas Penukaran Uang Kecil-Lp', 0),
(167, '3116', 'Kas Kecil Penjualan', 0),
(168, '3117', 'Kas Kecil Operasi', 0),
(169, '3118', 'Penambahan Uang Kecil Toko', 0),
(170, '3119', 'Kas Modal Peak Season', 0),
(171, '311', 'Kas Kecil GA', 0),
(172, '311', 'Kas kecil Op. DC Balaraja', 0),
(173, '311', 'Petty Cash u/Hub Surabaya', 0),
(174, '311', 'Petty Cash u/Hub Bandung', 0),
(175, '311', 'Petty Cash u/DC Halim', 0),
(176, '311', 'Kas Kecil Op. DC Medan', 0),
(177, '311', 'Kas Kecil Op. DC Semarang', 0),
(178, '311', 'KAS KECIL MCC', 0),
(179, '311', 'Kas kecil Finance Corporate', 0),
(180, '311', 'Kas Kecil Internal Audit', 0),
(181, '315', 'Kas Kecil Purchasing - MDS', 0),
(182, '315', 'PETY CASH -Sekretaris HRD & CE', 0),
(183, '3201', 'Lippo 704.30.09927.8', 0),
(184, '3205', 'CIMB-28201-00129-003(Exlp8429-', 0),
(185, '3208', 'Lippo 546.30.00600-7,Kudus', 0),
(186, '3214', 'CIMB-43901-00142-002(explp0700', 0),
(187, '3215', 'CIMB-17201-00213-009(exlp11257', 0),
(188, '321', 'CIMB-31601-00008-008(exlp09353', 0),
(189, '321', 'CIMB-38801-00206-002(exlp05732', 0),
(190, '321', 'CIMB-38801-00207-008(exlp05733', 0),
(191, '321', 'CIMB-26501-00119-005(exlp01194', 0),
(192, '321', 'CIMB-39301-00017-004(exlp10055', 0),
(193, '321', 'CIMB-39301-00026-003(exlp10999', 0),
(194, '3224', 'CIMB-26501-00181-002(exlp04010', 0),
(195, '322', 'LIPPO 720-30-09691-7 BANDUNG', 0),
(196, '322', 'CIMB-20501-00377-007(exlp09692', 0),
(197, '322', 'CIMB-41101-00179-001(exlp10626', 0),
(198, '322', 'CIMB-44501-00257-005(exlp88886', 0),
(199, '322', 'CIMB-44501-00139-003(exlp65000', 0),
(200, '322', 'CIMB-44301-00178-007(exlp02032', 0),
(201, '322', 'CIMB-443-01-00179-003(exlp0203', 0),
(202, '3232', 'CIMB-44501-00140-004(exlp65001', 0),
(203, '3239', 'CIMB-23401-00166-005(exlp70042', 0),
(204, '323', 'CIMB-26301-00270-005(exlp09003', 0),
(205, '323', 'CIMB-26301-00272-007(exlp09008', 0),
(206, '323', 'CIMB-32801-00040-004(exlp20150', 0),
(207, '323', 'CIMB-32801-00048-002(exlp20250', 0),
(208, '323', 'CIMB-47002-00187-000(exlp78454', 0),
(209, '3240', 'Lippo 704.30.14.001.1', 0),
(210, '3241', 'Lippo 570.30.81.041.1 Karawaci', 0),
(211, '324', 'BCA Mds Cito sby 60901', 0),
(212, '324', 'Mandiri Mds Cito sby 60923', 0),
(213, '324', 'BNI Mds Cito Sby 2166', 0),
(214, '324', 'BCA291567117-MdsKaltm', 0),
(215, '3256', 'BCA 86803000560 Cikokol', 0),
(216, '3258', 'BCA 008-30-15-92-3 Bdg', 0),
(217, '325', 'BCA 009-078-411-1 Semarang', 0),
(218, '325', 'BCA 119-0650-002 Jambi', 0),
(219, '325', 'BCA  054.02.44.308 Tasikmala', 0),
(220, '3261', 'CIMB-Rp-GSB-MDS', 0),
(221, '3262', 'CIMB-Rp-GSB-Dividen-MDS', 0),
(222, '3263', 'CIMB-Rp-NYI MAS-MDS', 0),
(223, '3264', 'CIMB-Rp-TKR-RightIssue', 0),
(224, '3265', 'CIMB-Rp-TKR-MDS', 0),
(225, '3266', 'CIMB-US$-TKR-MDS', 0),
(226, '3267', 'CIMB Niaga 085.01.01460.003', 0),
(227, '3268', 'CIMB-MDS-0850101230000', 0),
(228, '3269', 'CIMB-MDS-0850101231006', 0),
(229, '326', 'BCA Credit Card MDS 8680306177', 0),
(230, '326', 'BNI 190708310 - PINANGSIA', 0),
(231, '326', 'BNI-0177546661-MFB', 0),
(232, '326', 'BNI Bengkulu 0208487929 (OPR M', 0),
(233, '326', 'BNI Kendari 0201965392 (OPR MD', 0),
(234, '327', 'Citibank  3232, Jkt.', 0),
(235, '327', 'DNI  54653, Jkt', 0),
(236, '327', 'Deutsche  729-050 U$', 0),
(237, '327', 'CIMB-47001-00473-006(exlp81197', 0),
(238, '3287', 'CIMB-MDS-0850101232002', 0),
(239, '3288', 'CIMB-MDS-0850101233008', 0),
(240, '3289', 'CIMB-MDS-0850101277002', 0),
(241, '328', 'Lippo 704.30.145.52.7 JKT', 0),
(242, '328', 'CLOSED-Lippo 7043014554.3', 0),
(243, '3290', 'CIMB-MDS-0850101278008', 0),
(244, '3291', 'CIMB-MDS-0850101236006', 0),
(245, '3292', 'CIMB-MDS-0850101237002', 0),
(246, '3293', 'CIMB-MDS-0850101238008', 0),
(247, '3294', 'CIMB-MDS-0850101239004', 0),
(248, '3295', 'CIMB-MDS-0850101240005', 0),
(249, '3296', 'CIMB-MDS-0850101241001', 0),
(250, '3297', 'CIMB-MDS-0850200523009', 0),
(251, '3298', 'CIMB-MDS-0850200524005', 0),
(252, '3299', 'Mandiri-1190005571698-mds', 0),
(253, '329', 'CIMB-22901-00092-003(exlp01717', 0),
(254, '329', 'CIMB-43901-00143-008(exlp07009', 0),
(255, '329', 'CIMB-46701-00151-003(exlp10600', 0),
(256, '329', 'CIMB-28201-00178-002(exlp08750', 0),
(257, '32', 'BCA-MDS-7610499991', 0),
(258, '32', 'BCA-MDS-7610499966', 0),
(259, '32', 'BCA-MDS-7610499699', 0),
(260, '32', 'BCA-MDS-7610499818', 0),
(261, '32', 'Permata-0701312880-mds', 0),
(262, '32', 'Permata-0701312600-mds', 0),
(263, '32', 'BII-2290200600-MDS', 0),
(264, '32', 'BII-2290200590-MDS', 0),
(265, '32', 'Mayapada-1303001330.3-mds', 0),
(266, '32', 'CIMB-0850101242007-MDS', 0),
(267, '32', 'CIMB-0850101243003-MDS', 0),
(268, '32', 'CIMB-0850101279004-MDS', 0),
(269, '32', 'CIMB-0850101280005-MDS', 0),
(270, '32', 'CIMB 115.01.00027.001 Aceh', 0),
(271, '32', 'BNI-MDS-180512524', 0),
(272, '32', 'BNI-MDS-180512580', 0),
(273, '32', 'BCA-3831118090-MDS-MDN', 0),
(274, '32', 'CIMB-0850101246001-MDS', 0),
(275, '32', 'CIMB-0850101247007-MDS', 0),
(276, '32', 'CIMB-0850101281001-MDS', 0),
(277, '32', 'CIMB-0850101282007-MDS', 0),
(278, '32', 'CIMB-0850101283003-MDS', 0),
(279, '32', 'BNI-198396222-MDS', 0),
(280, '320', 'CIMB-0850101251006-MDS', 0),
(281, '3200', 'CIMB-0850101252002-MDS', 0),
(282, '32000', 'CIMB-0850101284009-MDS', 0),
(283, '320000', 'CIMB-0850101285005-MDS', 0),
(284, '3200000', 'BCA-0083170660-MDS-BDG', 0),
(285, '32', 'CIMB-0850101255000-MDS', 0),
(286, '32', 'CIMB-0850101256006-MDS', 0),
(287, '32', 'CIMB-0850101257002-MDS', 0),
(288, '32', 'CIMB-0850101258008-MDS', 0),
(289, '32', 'BCA-0095055589-MDS', 0),
(290, '32', 'CIMB-0850101259004-MDS', 0),
(291, '32', 'CIMB-0850101260005-MDS', 0),
(292, '32', 'BCA-0372892020-MDS', 0),
(293, '32', 'CIMB-0850101261001-MDS', 0),
(294, '32', 'CIMB-0850101262007-MDS', 0),
(295, '32', 'CIMB-0850101263003-MDS', 0),
(296, '32', 'CIMB-0850101264009-MDS', 0),
(297, '32', 'BCA-4290525255-MDS', 0),
(298, '32', 'CIMB-0850101265005-BLmds', 0),
(299, '32', 'CIMB-0850101266001-MDS', 0),
(300, '32', 'BCA-0491579900-MDS', 0),
(301, '32', 'CIMB-0850101267007-MDS', 0),
(302, '32', 'CIMB-0850101268003-MDS', 0),
(303, '32', 'BCA-026-17-52777-MDS', 0),
(304, '32', 'CIMB-0850101269009-MDS', 0),
(305, '32', 'CIMB 0850101270000-MDS', 0),
(306, '32', 'CIMB-0850101271006-MDS', 0),
(307, '32', 'BCA-0253204556-MDS', 0),
(308, '32', 'BII-2.518.010419 Gorontalo', 0),
(309, '32', 'BNI Luwuk Banggai 0208593062', 0),
(310, '32', 'CIMB-0850101272002-MDS', 0),
(311, '32', 'CIMB-0850101273008-MDS', 0),
(312, '32', 'CIMB-0850101274004-MDS', 0),
(313, '32', 'CIMB-0850101286001-MDS', 0),
(314, '32', 'CIMB-0850101276006-MDS', 0),
(315, '32', 'BCA-029-16-75700-MDS', 0),
(316, '32', 'CIMB 085-01-01362-00-1', 0),
(317, '32', 'CIMB 085-01-01367-00-1', 0),
(318, '32', 'CIMB 085-01-01368-00-7', 0),
(319, '32', 'CIMB 085-01-01369-003', 0),
(320, '32', 'CIMB 085-01-01375-004', 0),
(321, '32', 'CIMB 085-01-01377-006', 0),
(322, '32', 'CIMB 085-01-01379-008', 0),
(323, '32', 'CIMB 079-01-00990-00-1', 0),
(324, '32', 'CIMB 085-01-01364-00-3', 0),
(325, '32', 'CIMB 085-01-01372-00-6', 0),
(326, '32', 'CIMB 470-01-00751-00-6', 0),
(327, '32', 'BCA 761-06-45750 MDN', 0),
(328, '32', 'BCA 761-06-45351 BDG', 0),
(329, '32', 'BCA 761-06-45652 SMG', 0),
(330, '32', 'BCA 761-06-46853 YGY', 0),
(331, '32', 'BCA 761-06-46454 SBY', 0),
(332, '32', 'BCA 761-06-46055 BALI', 0),
(333, '32', 'BCA 761-06-46756 MND', 0),
(334, '32', 'BCA 761-06-47957 MKSR', 0),
(335, '32', 'BCA 761-06-48058 PTNK', 0),
(336, '32', 'BRI 0120.01.001736.30.3', 0),
(337, '32', 'Mandiri 1550004306380 Pinangsi', 0),
(338, '32', 'Mandiri 1550004306364 Pinangsi', 0),
(339, '32', 'Mayapada 102-30-80030-0', 0),
(340, '32', 'NOBU 168.30.00177.9', 0),
(341, '32', 'CIMB 115.01.00105.003 OPR MDS', 0),
(342, '32', 'BII 2.290.200911 Cab. Karawaci', 0),
(343, '32', 'BII 2.290.200870 Karawaci', 0),
(344, '32', 'BRI 0120.01.002044.30.1', 0),
(345, '32', 'Danamon 007706111114', 0),
(346, '32', 'Nobu 301-30-000065 Manado', 0),
(347, '32', 'Mandiri 151.000.639078.2 Palu', 0),
(348, '32', 'NOBU-801-30-01888-8 Medan', 0),
(349, '32', 'NOBU-168-30-00188-4 Karawaci', 0),
(350, '32', 'Mandiri 159.000.995577.3 Sampi', 0),
(351, '32', 'CIMB-63401-00046-003 Jakarta', 0),
(352, '32', 'UOB 327.304.001.1', 0),
(353, '32', 'Nobu 601-30-00003-3 Ambon', 0),
(354, '32', 'BNP Paribas HO 04010-002248-00', 0),
(355, '330', 'Deposito Berjangka Rupiah', 0),
(356, '3364', 'MS - CIMB (ex Obl Wjy Karya2)', 0),
(357, '3365', 'MS -  Lippo Ckrg (ex Obl MPPA)', 0),
(358, '3366', 'MS - Petrosea (ex Obl BNI46)', 0),
(359, '3367', 'MS - Star Pcfc (ex Obl Federal', 0),
(360, '3401', 'Credit Card', 0),
(361, '3402', 'Credit Card - Bca', 0),
(362, '3403', 'Credit Card - Amex', 0),
(363, '3404', 'Credit Card - Visa', 0),
(364, '3405', 'Credit Card - Master', 0),
(365, '3408', 'Credit Card Japan Bank', 0),
(366, '3410', 'Credit Card - Diners', 0),
(367, '3413', 'Credit Card - BNI', 0),
(368, '3414', 'Credit Card - Mandiri', 0),
(369, '3420', 'Setoran D.Prjalanan-Cc', 0),
(370, '3430', 'Travel Cheque', 0),
(371, '3431', 'Debet Card-LIPPO', 0),
(372, '3432', 'Debet Card-BCA', 0),
(373, '3434', 'Debet Card-BNI', 0),
(374, '3440', 'Debet Card-Pro Card Dharmala', 0),
(375, '3441', 'Debet Card-Bali Access', 0),
(376, '3442', 'Debet Card-Maestro/Star', 0),
(377, '3443', 'Tunai Bca', 0),
(378, '3444', 'Tunai Lippo', 0),
(379, '344', 'Debet Card - Mandiri', 0),
(380, '3450', 'Kupon Supplier.....', 0),
(381, '3452', 'Piutang Lain Penjualan', 0),
(382, '3453', 'Promo Card', 0),
(383, '3460', 'Piutang Karyawan L.1-3', 0),
(384, '3461', 'Piutang Karyawan L.4-5', 0),
(385, '3462', 'Piutang Karyawan Lainnya', 0),
(386, '3463', 'Piutang Kary (BPJS Kesehatan)', 0),
(387, '3464', 'Piutang Lain-Pt Ddn', 0),
(388, '346', 'Piutang SOB Corporate', 0),
(389, '346', 'Piutang SOB MSM', 0),
(390, '346', 'Piutang DC', 0),
(391, '346', 'AR DC Konsy. Unidentified', 0),
(392, '346', 'AR DC Konsy. Unapplied', 0),
(393, '346', 'AR DC Konsy. Unbilled', 0),
(394, '346', 'Piutang DC - F.Cost MDS', 0),
(395, '346', 'Piutang Penjualan Kupon MDS', 0),
(396, '346', 'Piutang Vendor 2', 0),
(397, '346', 'Piutang Vendor 3', 0),
(398, '346', 'Piutang Vendor 4', 0),
(399, '346', 'Piutang Vendor 5', 0),
(400, '3471', 'Piutang Sodexo', 0),
(401, '3472', 'Piutang Pt.Mthr.Graha Fantasi', 0),
(402, '3475', 'Piutang Pt Multipolar', 0),
(403, '3479', 'Piutang tenant property', 0),
(404, '347', 'Piutang PT MDS ke Property', 0),
(405, '347', 'Piutang PT MDS ke Corporate', 0),
(406, '347', 'Piutang PT MDS ke MFB', 0),
(407, '347', 'Piutang Pemegang Saham', 0),
(408, '3487', 'Piutang Promosi', 0),
(409, '3488', 'Piutang Lainnya', 0),
(410, '3489', 'Piutang Fixture Suppl Konsy', 0),
(411, '348', 'Piutang seragam SPG', 0),
(412, '3498', 'Piutang Bunga', 0),
(413, '349', 'Piutang Modal Koperasi', 0),
(414, '349', 'Piut Corp (PU) ke MDS (PU)', 0),
(415, '349', 'Piut MDS (PU) ke Corp (PU)', 0),
(416, '3601', 'Uang Muka Beli Aktiva', 0),
(417, '3602', 'Uang Muka Store Plan.', 0),
(418, '3603', 'Uang Muka Proyek', 0),
(419, '3604', 'Uang Muka FA Lainnya', 0),
(420, '3611', 'Uang Muka Beli Barang Dagang', 0),
(421, '3621', 'Uang Muka Sewa', 0),
(422, '3624', 'Uang Muka Md', 0),
(423, '3627', 'Uang muka utk prepayment', 0),
(424, '3628', 'Uang Muka china Office', 0),
(425, '3629', 'Uang Muka Lainnya', 0),
(426, '3701', 'Pers.Brg Dagangan Neraca', 0),
(427, '3720', 'Pers. Seragam', 0),
(428, '3721', 'Pers. Kantong Plastik', 0),
(429, '3722', 'Pers. Label', 0),
(430, '3723', 'Pers. Supplies Stock Room', 0),
(431, '372', 'BOTTOM ND BOYS - Sm2', 0),
(432, '372', 'Titipan sample bag SM-2', 0),
(433, '372', 'Sample Urban Scape SMT2', 0),
(434, '372', 'BOTTOM ND GIRLS - Sm2', 0),
(435, '372', 'Persediaan sample a3 s2 dept e', 0),
(436, '372', 'Sample Boys 5-10 Semester II', 0),
(437, '372', 'Sample Boys 11-14 Semester 11', 0),
(438, '372', 'Sample Girls 5-10 Semester II', 0),
(439, '372', 'Sample Girls 11-14 Semester II', 0),
(440, '372', 'Persediaan Sample Dept Dress S', 0),
(441, '372', 'DENIM GIRLS - Sm2', 0),
(442, '372', 'DENIM BOYS - Sm2', 0),
(443, '373', 'BOTTOM ND BOYS', 0),
(444, '373', 'Titipan sample bag SM-1', 0),
(445, '373', 'Sample Urban Scape SMT 1', 0),
(446, '373', 'BOTTOM ND GIRLS', 0),
(447, '373', 'Persediaan Sample A3 S1Dept Es', 0),
(448, '373', 'Sample Boys 5-10 Semester I', 0),
(449, '373', 'Sample Boys 11-14 Semester I', 0),
(450, '373', 'Sample Girls 5-10 Semester I', 0),
(451, '373', 'Sample Girls 11-14 Semester I', 0),
(452, '373', 'Persediaan Sample Dept Dress S', 0),
(453, '373', 'DENIM GIRLS', 0),
(454, '373', 'DENIM BOYS', 0),
(455, '378', 'TOP KNIT BOYS - Sm2', 0),
(456, '378', 'Pers. Sample S2 Md A1 Missy', 0),
(457, '378', 'Pers. Sample S2 Md A2 Casual', 0),
(458, '378', 'Pers. Sample S2 Md A5 Cosmetic', 0),
(459, '378', 'Pers. Sample S2 Md A7 Toys', 0),
(460, '378', 'TOP KNIT GIRLS - Sm2', 0),
(461, '378', 'Pers. Sample S2 Md A3 Infant', 0),
(462, '378', 'Pers. Sample S2 Md A2 Formal', 0),
(463, '378', 'Pers. Sample S2 Md A3 Toddler', 0),
(464, '378', 'TOP WOVEN GIRLS - Sm2', 0),
(465, '378', 'Pers. Sample S2 Md Quality Ass', 0),
(466, '378', 'TOP WOVEN BOYS - Sm2', 0),
(467, '378', 'Pers. Sample S2 Md A1 Spc. Occ', 0),
(468, '378', 'Pers. Sample S2 Md A1 Intimate', 0),
(469, '3792', 'PERSEDIAAN SAMPLE S1 MD DEP34', 0),
(470, '3793', 'PERSEDIAAN SAMPLE MD A8 HOUSEW', 0),
(471, '379', 'TOP KNIT BOYS', 0),
(472, '379', 'Pers. Sample S1 Md A1 Missy', 0),
(473, '379', 'Pers. Sample S1 Md A2 Casual', 0),
(474, '379', 'Pers. Sample S1 Md A4 Lds Shoe', 0),
(475, '379', 'Pers. Sample S1 Md A7 Toys', 0),
(476, '379', 'TOP KNIT GIRLS', 0),
(477, '379', 'Pers. Sample S1 Md A3 Infant', 0),
(478, '379', 'Pers. Sample S1 Md A2 Formal', 0),
(479, '379', 'Pers. Sample S1 Md A3 Toddler', 0),
(480, '379', 'TOP WOVEN GIRLS', 0),
(481, '379', 'Pers. Sample S1 Md Quality Ass', 0),
(482, '379', 'TOP WOVEN BOYS', 0),
(483, '379', 'Pers. Sample S1 Md A1 Spc Occa', 0),
(484, '379', 'Pers. Sample S1 Md A1 Intmate', 0),
(485, '37', 'Persd PermanenCard Prestige', 0),
(486, '37', 'Pers Application Form & Temp C', 0),
(487, '37', 'Pers Stater Pack', 0),
(488, '37', 'Pers Regular card', 0),
(489, '37', 'Pers Application form & Regula', 0),
(490, '37', 'Pers New Premium Temporary Car', 0),
(491, '37', 'Pers. New Premium Card', 0),
(492, '37', 'Pers. Katalog MCC', 0),
(493, '37', 'Pers. Sticker Barcode', 0),
(494, '37', 'Pers. New Regular Card', 0),
(495, '37', 'Pers. Beauty Temporary Card', 0),
(496, '37', 'Pers. Beauty Card', 0),
(497, '3810', 'Asuransi Byr Dimuka', 0),
(498, '3811', 'Sewa Dibayar Dimuka', 0),
(499, '3812', 'Expense Dibayar Dimuka', 0),
(500, '3814', 'B.Byr Dimuka Lainnya', 0),
(501, '3831', 'Pajak Byr Dimuka 23/26', 0),
(502, '3832', 'Pajak Byr Dimuka 25/29', 0),
(503, '3834', 'Ppn Masukan', 0),
(504, '3836', 'PPN masukan Claim', 0),
(505, '3837', 'PPN Masukan yg akan datang Bel', 0),
(506, '3838', 'PPN Masukan yg akan datang Kon', 0),
(507, '3841', 'Pajak Byr Dimuka 23/26 - belum', 0),
(508, '4034', 'Investasi PT ASRI AGUNG', 0),
(509, '4035', 'Investasi PT BHAKTI SARANA', 0),
(510, '4310', 'Instalasi Ac', 0),
(511, '4311', 'Instalasi Ac - Transisi', 0),
(512, '4321', 'Instalasi Genset-Listrik - Tra', 0),
(513, '4341', 'Instalasi Telepon - Transisi', 0),
(514, '4351', 'Asset Dlm Penyelesaian Instala', 0),
(515, '4410', 'Peralatan Komputer', 0),
(516, '4411', 'Peralatan Komputer - Transisi', 0),
(517, '4421', 'Peralatan Komunikasi - Transis', 0),
(518, '4430', 'Peralatan Furn & Rt', 0),
(519, '4431', 'Peralatan Furn & Rt - Transisi', 0),
(520, '4441', 'Peralatan Visual / Transisi', 0),
(521, '4451', 'Peralatan Fixtures - Transisi', 0),
(522, '4461', 'Peralatan Video Production - T', 0),
(523, '4510', 'Kendaraan - Mobil', 0),
(524, '4511', 'Kendaraan Mobil - Transisi', 0),
(525, '4551', 'Kendaraan Motor - Transisi', 0),
(526, '4611', 'Akm. Peny. Instalasi', 0),
(527, '4621', 'Akm. Peny. Gen & List', 0),
(528, '4641', 'Akm. Peny. Inst.Telep', 0),
(529, '4711', 'Akm. Peny. Komputer', 0),
(530, '4721', 'Akm. Peny. Komunikasi', 0),
(531, '4730', 'Akm. Peny. Furniture & Rt', 0),
(532, '4731', 'Akm. Peny. Furniture & Rt', 0),
(533, '4741', 'Akm. Peny. Visual', 0),
(534, '4751', 'Akm. Peny. Dekorasi (Fixture)', 0),
(535, '4761', 'Akm. Peny. Video Production', 0),
(536, '4811', 'Akm. Peny. - Mobil', 0),
(537, '4851', 'Akm. Peny. - Motor', 0),
(538, '4901', 'Renovasi Matahari Tower', 0),
(539, '4903', 'Renovasi Bangunan', 0),
(540, '4904', 'Akum. Peny. Renovasi Bangunan', 0),
(541, '4905', 'Asset Dlm Penyelesaian Renovas', 0),
(542, '4906', 'Aktiva Dalam Penyelesaian (mai', 0),
(543, '4918', 'Biaya Ditangguhkan-Right Issue', 0),
(544, '492', 'Beban ditangguhkan - Provisi P', 0),
(545, '4936', 'Kontrak Dalam Pelaksanaan', 0),
(546, '4937', 'LIsensi Untuk Hardi Armies', 0),
(547, '4939', 'License utk Walt Disney', 0),
(548, '4940', 'Jaminan Sewa', 0),
(549, '4941', 'Jaminan Tambahan Listrik', 0),
(550, '4942', 'Jaminan Tambahan Telpon', 0),
(551, '4943', 'Jaminan Lainnya', 0),
(552, '4950', 'Software', 0),
(553, '4951', 'Ak.Amortisasi Software', 0),
(554, '4960', 'Klaim Asuransi', 0),
(555, '4962', 'Asset Pajak Tangguhan', 0),
(556, '4970', 'Intelectual Property', 0),
(557, '4998', 'Deviden', 0),
(558, '4999', 'Retain Earning', 0),
(559, '5120', 'Hutang Dagang - Beli Putus', 0),
(560, '5121', 'Hutang Dagang - Konsinyasi', 0),
(561, '5123', 'Hutang Dagang Lainnya', 0),
(562, '5126', 'Ht. Dagang Beli Putus lainnya', 0),
(563, '5127', 'Ht. Dagang Konsinyasi lainnya', 0),
(564, '5140', 'Hutang Pajak Pph Ps.21', 0),
(565, '5141', 'Hutang Pajak Pph Ps 23 & Final', 0),
(566, '5142', 'Hutang Pajak Pph Ps 25', 0),
(567, '5143', 'Hutang Pajak Pph Ps.26', 0),
(568, '5145', 'Hutang PB I', 0),
(569, '5146', 'Pajak (PPN) Keluaran', 0),
(570, '5148', 'Hutang Pajak Pph Ps. 29', 0),
(571, '514', 'Hutang Pajak PPh Ps.4 ay.2', 0),
(572, '514', 'Pajak(PPN) Keluaran-Non Sales', 0),
(573, '5150', 'Kewajiban Pajak Tangguhan', 0),
(574, '5200', 'Biaya Bunga (Bank) Ymh Dibayar', 0),
(575, '5201', 'Biaya Asuransi Ymh Dibayar', 0),
(576, '5202', 'Pesangon Kep. 150 Ymh Dibayar', 0),
(577, '5203', 'Biaya Listrik Ymh Dibayar', 0),
(578, '5204', 'Biaya Telp.& Telex Ymh Dibayar', 0),
(579, '5205', 'Thr Dan Bonus Ymh Dibayar', 0),
(580, '5206', 'Fee Sgv Ymh Dibayar', 0),
(581, '5208', 'Biaya Sewa Ymh Dibayar', 0),
(582, '5209', 'Biaya Lainnya Ymh Dibayar', 0),
(583, '520', 'Cadangan Point', 0),
(584, '5210', 'Hutang Biaya', 0),
(585, '5211', 'Cleaning Servis Yang Masih Har', 0),
(586, '5215', 'Biaya Air PAM yang masih harus', 0),
(587, '5217', 'Biaya Security Yang Masih Haru', 0),
(588, '5224', 'Cadangan Insentive Sales Targe', 0),
(589, '5230', 'Kupon Mcc', 0),
(590, '5231', 'Kupon Matahari Hijau Dan Kunin', 0),
(591, '5232', 'E-Gift Voucher', 0),
(592, '5240', 'Sewa Yang Diterima Dimuka', 0),
(593, '5241', 'Bunga Diterima Di Muka', 0),
(594, '5243', 'Pendapatan Lain Diterima Dimuk', 0),
(595, '5244', 'Pendapatan Diterima Dimuka (R/', 0),
(596, '524', 'Htg Corp (PU) ke MDS (PU)', 0),
(597, '524', 'Htg MDS (PU) ke Corp (PU)', 0),
(598, '5250', 'Titipan Lain-Lain', 0),
(599, '5252', 'Titipan uang penjualan', 0),
(600, '5254', 'Titipan Supplier (Margin)', 0),
(601, '525', 'Titiapan MDS Konsinyasi Fashio', 0),
(602, '525', 'Titipan Kardus', 0),
(603, '525', 'Titipan', 0),
(604, '525', 'Titipan PKLL', 0),
(605, '525', 'Titipan Promo Credit Card', 0),
(606, '525', 'Kelebihan pencairan Credit Car', 0),
(607, '526', 'Hutang Corporate ke PT MDS', 0),
(608, '5278', 'Ht. Mpp Kepada Supplier Club', 0),
(609, '527', 'Hutang PT MDS ke Property - MP', 0),
(610, '527', 'Hutang PT MDS ke Corporate - M', 0),
(611, '527', 'Hutang PT MDS ke MFB - MPP', 0),
(612, '527', 'Hutang Royalty ke PT. MI', 0),
(613, '5280', 'Ht. Biaya', 0),
(614, '5281', 'Ht. Astek', 0),
(615, '5282', 'Ht. Lainnya-Tax', 0),
(616, '5284', 'Ht. Jaminan Sewa', 0),
(617, '5285', 'Ht. Deviden', 0),
(618, '5289', 'Hutang lainnya ( cadangan PPN', 0),
(619, '528', 'Hutang Lain lain', 0),
(620, '528', 'Hutang Retensi Uang Muka', 0),
(621, '528', 'Hutang Jamsostek - COY', 0),
(622, '528', 'JP Karyawan ', 0),
(623, '529', 'Titipan Md A2 Casual', 0),
(624, '529', 'Titipan Md A3 Girls', 0),
(625, '529', 'Titipan Md A3 Boys', 0),
(626, '529', 'Titipan Md A5 Cosmetic&Acc', 0),
(627, '529', 'Titipan Md A8 Housewares', 0),
(628, '529', 'Titipan Md A3 Infant', 0),
(629, '529', 'Titipan MD Accessories MDS', 0),
(630, '529', 'Titipan Md A1 Intimate Apparel', 0),
(631, '52', 'Titipan proyek', 0),
(632, '52', 'Titipan MD Children World Glob', 0),
(633, '52', 'Titipan Kymco', 0),
(634, '52', 'Titipan Bazzar', 0),
(635, '52', 'Titipan fixture suppl konsy', 0),
(636, '52', 'Titipan Supplier Mens', 0),
(637, '52', 'Titipan Supplier Ladies', 0),
(638, '52', 'Titipan Supplier Shoes', 0),
(639, '52', 'Titipan Supplier DP', 0),
(640, '52', 'Titipan Supplier CV', 0),
(641, '52', 'Titipan A8 - Plastic & Storage', 0),
(642, '52', 'Titipan A8 - Table Top', 0),
(643, '52', 'Titipan A8 - Kitchen', 0),
(644, '52', 'Titipan A8 - Appliance', 0),
(645, '52', 'Titipan A8 - Beverly & Linen', 0),
(646, '52', 'Titipan A8 - Bag & Travel', 0),
(647, '52', 'Titipan A8 - Decor & Stationar', 0),
(648, '5410', 'Hutang Sewa PT. Bank Panin (Ps', 0),
(649, '5413', 'Hutang CIMB Niaga (Short Term)', 0),
(650, '5414', 'Hutang CIMB Niaga (Long Term)', 0),
(651, '5415', 'Vendor Loan from MP - Vendor L', 0),
(652, '54', 'Hutang Afiliasi', 0),
(653, '5701', 'Modal Disetor', 0),
(654, '5703', 'Premi/Agio', 0),
(655, '5704', 'Due to MPPA for MDS Shares - D', 0),
(656, '5705', 'Paid in Capital - ACC Ltd - Pa', 0),
(657, '5706', 'Paid in Capital - MAC Ltd - Pa', 0),
(658, '5708', 'Biaya Emisi Saham', 0),
(659, '5713', 'Equity - UCC', 0),
(660, '5714', 'UCC-restructuring value - Inve', 0),
(661, '5999', 'Retained Earnings', 0),
(662, '6101', 'Penjualan Toko', 0),
(663, '6109', 'Penjualan Tenant', 0),
(664, '6201', 'Discount Penjualan Toko', 0),
(665, '6204', 'Discount Voucher Mcc', 0),
(666, '6401', 'Discount Voucher Visa Matahari', 0),
(667, '6500', 'Net Sales', 0),
(668, '6600', 'Service - sales - Consulting f', 0),
(669, '7100', 'Persediaan Awal', 0),
(670, '7200', 'Pembelian Toko', 0),
(671, '7204', 'Pembelian Konsinyasi', 0),
(672, '7206', 'Retur Pembelian Toko', 0),
(673, '7207', 'Discount Pembelian', 0),
(674, '7208', 'Biaya Adm 3% Fashion/SPM', 0),
(675, '7209', 'CLM- Potongan Pembelian SPM', 0),
(676, '7210', 'Biaya Adm 3%', 0),
(677, '7211', 'PP ke Gross Margin', 0),
(678, '7213', 'Potongan Quality Control', 0),
(679, '7216', 'Potong Pembayaran Barang Telat', 0),
(680, '7220', 'Ongkos Kirim', 0),
(681, '7221', 'Kerja Sama Promosi Tunai', 0),
(682, '7222', 'Retur Antar Toko', 0),
(683, '7223', 'Kerja Sama Promosi Tunai CV', 0),
(684, '7300', 'Persediaan Akhir', 0),
(685, '7500', 'Cogs - Total Hpp', 0),
(686, '7600', 'Cost of service - Cost of cons', 0),
(687, '8003', 'Pendapatan Sewa Ruangan', 0),
(688, '8004', 'Pph Ps.23-Pend Sewa Ruangan', 0),
(689, '8005', 'Pendapatan Sewa Graha Fantasi', 0),
(690, '8008', 'Pendapatan Joint Promotion', 0),
(691, '8010', 'Profit Sharing Pot. PPH', 0),
(692, '8011', 'Profit Sharing tdk. Pot. PPh', 0),
(693, '8014', 'By. Klaim ganti rugi', 0),
(694, '8030', 'Pendapatan Bunga', 0),
(695, '8031', 'Pendapatan Bunga Deposito', 0),
(696, '8032', 'Pendapatan Bunga R/K Jasa Giro', 0),
(697, '8033', 'Biaya Bunga', 0),
(698, '8034', 'Perjanjian Pinjaman/Provisi Kr', 0),
(699, '8041', 'Pendapatan Kirim', 0),
(700, '8042', 'Pendapatan RTV', 0),
(701, '8043', 'Pendapatan Pick Up', 0),
(702, '8044', 'Charter', 0),
(703, '8045', 'Warehouse Rental', 0),
(704, '8046', 'Pendapatan Packing', 0),
(705, '8047', 'Pendapatan Asuransi', 0),
(706, '8048', 'Pot. Discount Pdpt DC', 0),
(707, '8050', 'Kerugian Selisih Kurs', 0),
(708, '8052', 'Selisih Kurs Deposito,Mkt.Secu', 0),
(709, '8053', 'Selisih Kurs Bank', 0),
(710, '8055', 'Gain/Loss In Forex Exchange', 0),
(711, '8070', 'R/L Penjualan Saham', 0),
(712, '8073', 'Unrealized Gain On Market Secr', 0),
(713, '8076', 'Unrealized gain/loss on change', 0),
(714, '8077', 'gain/loss on sale invest in Su', 0),
(715, '8102', 'Pendapatan Lain-Lain R/K', 0),
(716, '8104', 'Biaya (Pendapatan) Non Operasi', 0),
(717, '8106', '(Pendapatan) Penjualan Kardus', 0),
(718, '8108', 'Rugi (Laba) toko tutup', 0),
(719, '8109', 'Laba/Rugi Penj.Aktiva Tetap', 0),
(720, '8110', 'Rugi akibat bencana', 0),
(721, '8111', 'Pendapatan Klaim Asuransi', 0),
(722, '82', 'INTEREST SWAP', 0),
(723, '8310', 'Pajak Penghasilan', 0),
(724, '8311', 'Deferred Pajak Penghasilan', 0),
(725, '8907', 'R/K Perantara DC', 0),
(726, '8908', 'R/K Perantara DC - F.Cost', 0),
(727, '8909', 'R/k Perantara Untuk AP', 0),
(728, '8910', 'R/k Perantara Fixed Asset', 0),
(729, '8913', 'R/k Perantara Gaji', 0),
(730, '8914', 'R/K Perantara Beli Putus', 0),
(731, '8915', 'R/K Perantara Konsinyasi', 0),
(732, '8916', 'R/K Perantara Lembur', 0),
(733, '8917', 'RK Perantara Cabang', 0),
(734, '8918', 'Rekening Perantara KKMG', 0),
(735, '8919', 'Rekening Perantara Transfer Fe', 0),
(736, '8920', 'Rekening Perantara Uang Kecil', 0),
(737, '9960', 'R/k Perantara Sales Audit', 0),
(738, '9999', 'Suspense', 0),
(739, '0', 'PERSEDIAAN HOT DELY', 0),
(740, '0', 'PERSEDIAAN PERLENGKAPAN', 0),
(741, '0', 'Akumulasi Peralatan(4710 - 476', 0),
(742, '0', 'FA Acumulation', 0),
(743, '0', 'Akumulasi Kendaraan(4810 - 485', 0),
(744, '0', 'Akumulasi Instalasi (4610 - 46', 0),
(745, '0', 'Akum.Renov.MTHR Tower', 0),
(746, '0', 'Account Exc. payroll Depreciat', 0),
(747, '0', 'Report R/L', 0),
(748, '0', 'Tenant Leasing', 0),
(749, '0', 'BGT - CONTROLLABLE ACCOUNT', 0),
(750, '0', 'BGT - CONTROLLABLE HO', 0),
(751, '0', 'CONTROLLABLE EXPENSE', 0),
(752, '0', 'Wages', 0),
(753, '0', 'Sewa Excl 2013,2014,2015', 0),
(754, '0', 'Sewa Excl s.charge', 0),
(755, '0', 'Service Charge', 0),
(756, '0', 'Sewa Corp ( 2013, 2014 & 2015)', 0),
(757, '0', 'Expense Maint. 0612,0630,0710', 0),
(758, '0', 'Bi. dbayar dmuka (3812-3814)', 0),
(759, '0', 'Credit Card (3443, 3442, 3401)', 0),
(760, '0', 'Account RL EC.00', 0),
(761, '0', 'Sales exl OA, Rabate, Rafaksi', 0),
(762, '0', 'DEPRESIASI BANGUNAN (1360 - 13', 0),
(763, '0', 'DEP (1300-13ZZ)', 0),
(764, '0', 'FA Report (3601-3604, 4906)', 0),
(765, '0', 'FA Report (1310 - 1370, 1380)', 0),
(766, '0', 'HRD ACCOUNT', 0),
(767, '0', 'GROSS PROFIT EXC.MCC', 0),
(768, '0', 'GP EXC.MCC & OA', 0),
(769, '0', 'GROSS PROFIT (EXC.MCC+ONGKOS A', 0),
(770, '0', 'GROSS PROFIT EXC.MCC+OA & TENA', 0),
(771, '0', 'COGS EXC.MCC+ONGKOS ANGKUT', 0),
(772, '0', 'Hak sewa & pakai  (4930 & 4932', 0),
(773, '0', 'Income BM', 0),
(774, '0', 'instalasi (4310 - 4351)', 0),
(775, '0', 'Interest Expense', 0),
(776, '0', 'INCENTIVE SALES TARGET', 0),
(777, '0', 'Comm MDS-(1010-14,1017,1021,10', 0),
(778, '0', 'Comm Corp-(1015-16,1018-1020,1', 0),
(779, '0', 'Kendaraan (4510 - 4551)', 0),
(780, '0', 'KESRA 0610-0689 & 0693-0699', 0),
(781, '0', 'LISTRIK 0670 0671', 0),
(782, '0', 'excl 01, 03 & 07', 0),
(783, '0', 'BANGUNAN (4140 - 4192)', 0),
(784, '0', 'Account Neraca', 0),
(785, '0', 'Jangan dipakai \"Salah\"', 0),
(786, '0', 'Outside Expense & Income', 0),
(787, '0', 'Outside Exp & Inc 2', 0),
(788, '0', 'Outside Exp & Inc 3', 0),
(789, '0', 'Outside Exp & Inc 4', 0),
(790, '0', 'Outside Expense & Income & Int', 0),
(791, '0', 'Base Payroll (0111, 011Z, 0770', 0),
(792, '0', 'Base Payroll 0111 & 011z', 0),
(793, '0', 'Peralatan (4410 - 4461)', 0),
(794, '0', 'Sewa (2030-2031)', 0),
(795, '0', 'SALES EXC.MCC (6204)', 0),
(796, '0', 'Sewa (2013-2015)', 0),
(797, '0', 'Sewa (2010-2015)', 0),
(798, '0', 'Sewa (2010-2020)', 0),
(799, '0', 'Biaya Sewa & Sc', 0),
(800, '0', 'Sewa (2010-2012)', 0),
(801, '0', 'Tenant Leasing', 0),
(802, '0', 'Tenant Income Property', 0),
(803, '0', 'Tenant Income', 0),
(804, '0', 'TOTAL UANG MUKA', 0),
(805, '0', 'Time Zone Income', 0),
(806, '0', 'Uang muka', 0),
(807, '0', 'Sewa Excl s.charge', 0),
(808, '0', 'BIAYA YANG MASIH HARUS DIBAYR', 0),
(809, '0', 'Cencus', 0),
(810, '0', 'N-PIUT.CR.CARD', 0),
(811, '0', 'FA Cost', 0),
(812, '0', 'DEPRE INST EQP VEH RENOV BGN', 0),
(813, '0', 'DEPRE INST EQP VEH', 0),
(814, '0', 'Contribution Margin By Budget', 0),
(815, '0', 'Contribution Margin By exc. ou', 0),
(816, '0', 'FA-Akumulasi Bangunan', 0),
(817, '0', 'Account Neraca', 0),
(818, '0', 'Credit Card', 0),
(819, '0', 'Account Rugi Laba', 0),
(820, '0', 'Biaya Payroll - P', 0),
(821, '0', 'Base Payroll', 0),
(822, '0', '13th Month Salary Bonus', 0),
(823, '0', 'GL- Biaya Media -P-', 0),
(824, '0', 'Biaya Pajak - P', 0),
(825, '0', 'GL- Biaya Supplies - P-', 0),
(826, '0', 'Biaya ATK - P', 0),
(827, '0', 'Biaya Listrik - P', 0),
(828, '0', 'Biaya Kantong Plastik - P', 0),
(829, '0', 'Biaya Label - P', 0),
(830, '0', 'Biaya Keskar - P', 0),
(831, '0', 'Biaya Service Purchase - P', 0),
(832, '0', 'Biaya Pend & Pengembangan - P', 0),
(833, '0', 'Biaya Credit Card - P', 0),
(834, '0', 'Biaya Lain-lain - P', 0),
(835, '0', 'Biaya Perjamuan - P', 0),
(836, '0', 'Biaya Direksi - P', 0),
(837, '0', 'Biaya Perjalanan Dinas - P', 0),
(838, '0', 'Biaya Komunikasi - P', 0),
(839, '0', 'Biaya Asuransi  - P', 0),
(840, '0', 'Biaya Penyusutan FA - P', 0),
(841, '0', 'Biaya Penyusutan Renovasi - P', 0),
(842, '0', 'Biaya Amortisasi Retek - P', 0),
(843, '0', 'Biaya Amort Hak Sewa - P', 0),
(844, '0', 'Biaya Amort Hak Paten - P', 0),
(845, '0', 'By Am ditangguhkan - P', 0),
(846, '0', 'By Am ditangguhkan tanah - P', 0),
(847, '0', 'Biaya Amortisasi Obligasi - P', 0),
(848, '0', 'Biaya Penyusutan FA Exc 1360 &', 0),
(849, '0', 'Biaya Penyusutan FA - P', 0),
(850, '0', 'Biaya Konsultan - P', 0),
(851, '0', 'Biaya Equipment Rental', 0),
(852, '0', 'Biaya Maintenance & Repair', 0),
(853, '0', 'Biaya Sewa & SC - P', 0),
(854, '0', 'Biaya Sewa - P', 0),
(855, '0', 'Biaya Service Charge - P', 0),
(856, '0', 'Retained Earning - P', 0),
(857, '0', 'Thr Bonus ymh di bayar', 0),
(858, '0', 'PIUTANG KE PT MDS Tbk', 0),
(859, '0', 'Penjualan Bersih', 0),
(860, '0', 'Penjualan exc Disc MCC', 0),
(861, '0', 'Penj.exc Disc MCC+MSE', 0),
(862, '0', 'Harga Pokok Penjualan - P', 0),
(863, '0', 'Rental income AMD', 0),
(864, '0', 'Rental income AMD FROM MDS', 0),
(865, '0', 'Rental income AMD FROM MSM', 0),
(866, '0', 'Gross Profit', 0),
(867, '0', 'Gross Profit exc Disc MCC', 0),
(868, '0', 'GL- Biaya Non Operasi - P', 0),
(869, '0', 'GL- Pendapatan Sewa - P-', 0),
(870, '0', 'PPH 23 Pend Sewa - P', 0),
(871, '0', 'Pend Sewa Gondola - P', 0),
(872, '0', 'Biaya PPH 23 Gondola - P', 0),
(873, '0', 'Biaya Selisih Kurs -P-', 0),
(874, '0', 'Pend Bunga Lain 2 - P', 0),
(875, '0', 'Pend Bunga (Deposito) - P', 0),
(876, '0', 'Pend Bunga ( R/K ) - P', 0),
(877, '0', 'Biaya Bunga - P', 0),
(878, '0', 'Pend Sewa & SC DDN - P', 0),
(879, '0', 'Disc Promissory Notes - P', 0),
(880, '0', 'Swap Kontrak - P', 0),
(881, '0', 'Sewa Lain-Lain - P', 0),
(882, '0', 'R/L Penjualan Saham - P', 0),
(883, '0', 'Pendapatan Deviden - P', 0),
(884, '0', 'Peny Nav Reksadana & Lippo - P', 0),
(885, '0', 'R/L Reksadana & MS - P', 0),
(886, '0', 'Unrealized Gain on MS - P', 0),
(887, '0', 'Perjanjian Pinjaman Provisi -', 0),
(888, '0', 'Cad Pengurangan Toko - P', 0),
(889, '0', 'R/L Klaim Asr Kebakaran - P', 0),
(890, '0', 'Laba Penj Aktiva Tetap - P', 0),
(891, '0', 'MGT Fee Payroll & Sales - P', 0),
(892, '0', 'Biaya Lain-lain Pajak - P', 0),
(893, '0', 'Penghapusan Piutang ragu - P', 0),
(894, '0', 'Bunga Leasing - P', 0),
(895, '0', 'Biaya Restrukturisasi Toko - P', 0),
(896, '0', 'Rugi Laba Bag. Perusahaan - P', 0),
(897, '0', 'Taksiran Pajak Penghasilan - P', 0),
(898, '0', 'MGT -Biaya Media -P-', 0),
(899, '0', 'MGT -Biaya Supplies -P-', 0),
(900, '0', 'MGT -Pendapatan Sewa -P-', 0),
(901, '0', 'MGT -Biaya Lain-lain', 0),
(902, '0', 'Sales Exclude MCC', 0),
(903, '0', 'Credit Card', 0),
(904, '0', 'Pembelian Exc. Biaya', 0),
(905, '0', 'Gross Profit 6100-7500', 0),
(906, '0', 'Rental income T.Leasing', 0),
(907, '0', 'Group .......', 0),
(908, '0', '(5250-5251,5282&528A)', 0),
(909, '0', 'HUTANG KEPADA', 0),
(910, '0', 'TOTAL BIAYA YANG MASIH HARUS D', 0),
(911, '0', 'LAINNYA HJP', 0),
(912, '0', 'Operating Expense & Outside Ex', 0),
(913, '0', 'Piutang Credit Card', 0),
(914, '0', 'Piutang Credit Card (tanpa 342', 0),
(915, '0', 'Piutang karyawan', 0),
(916, '0', 'Pendapatan Property', 0),
(917, '0', 'Persediaan Brg Dagangan Incl.B', 0),
(918, '0', 'PESANGON', 0),
(919, '0', 'PERSEDIAAN SAMPE MD', 0),
(920, '0', 'PENGHASILAN YG DITERIMA DIMUKA', 0),
(921, '0', 'Revenue Tenant leasing(8004,81', 0),
(922, '0', 'Revenue Time Zone(8004,8005,80', 0),
(923, '0', 'BANK 3200-32ZZ', 0),
(924, '0', 'RBNK ( Bank 3200 - 32ZZ )', 0),
(925, '0', 'RENOVASI (4903 - 4903)', 0),
(926, '0', 'FOH 7401-7404', 0),
(927, '0', 'Income Gondola ( all )', 0),
(928, '0', 'Income Media Cost', 0),
(929, '0', 'Revenue Tenant leasing(8004,81', 0),
(930, '0', 'Revenue TIME ZONE(8004,8005,80', 0),
(931, '0', 'Kas (3100-31ZZ)', 0),
(932, '0', 'Exp.Media Cost (Excl.Income MC', 0),
(933, '0', 'Revenue MSM (7294,7296,7299)', 0),
(934, '0', 'Revenue MSM (7295,7297,7298)', 0),
(935, '0', 'Piutang (3401-34zz)', 0),
(936, '0', 'Piutang Jaminan (4935,4940-43)', 0),
(937, '0', 'TITIPAN MD ALL', 0),
(938, '0', 'Titipan ALL', 0),
(939, '0', 'TOTAL HUTANG JK.PENDEK LAINNYA', 0),
(940, '0', 'HUTANG JK.PENDEK LAINNYA', 0),
(941, '0', 'TITIPAN PROMOSI A9', 0),
(942, '0', 'TITIPAN PROMOSI MD', 0),
(943, '0', 'UANG MUKA BARANG DAGANAN', 0),
(944, '000', 'fff', 0);

-- --------------------------------------------------------

--
-- Table structure for table `coa_tb`
--

CREATE TABLE `coa_tb` (
  `id_coa_tb` int(11) NOT NULL,
  `account` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coa_tb`
--

INSERT INTO `coa_tb` (`id_coa_tb`, `account`, `nama`, `id_user`) VALUES
(2, '555', 'ggg', 0),
(3, '10', 'asd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `id_counter` int(11) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_edit` datetime NOT NULL,
  `tgl_delete` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id_counter`, `nama`, `kode`, `jumlah`, `tgl_buat`, `tgl_edit`, `tgl_delete`, `status`) VALUES
(1, 'Kas Kecil', 'DC-KK', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `id_departement` int(11) NOT NULL,
  `kode_loc` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `saldo1` float(19,2) NOT NULL,
  `pinjem` float(10,2) NOT NULL,
  `realisasi` float(10,2) NOT NULL,
  `saldo` float(10,2) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`id_departement`, `kode_loc`, `nama`, `saldo1`, `pinjem`, `realisasi`, `saldo`, `id_user`) VALUES
(1, '091', 'DC BALI', 5000000.00, 0.00, 0.00, 0.00, 0),
(2, '092', 'DC BALIKPAPAN', 0.00, 0.00, 0.00, 0.00, 0),
(3, '093', 'DC MAKASAR', 0.00, 0.00, 0.00, 0.00, 0),
(4, '094', 'DC MEDAN', 8500000.00, 2000000.00, 2125307.50, 19250232.00, 0),
(5, '095', 'DC BANDUNG', 0.00, 0.00, 0.00, 0.00, 0),
(6, '096', 'ROMOKALISARI-SURABAYA', 0.00, 0.00, 0.00, 0.00, 0),
(7, '097', 'DC BALARAJA', 0.00, 0.00, 0.00, 0.00, 0),
(8, '099', 'DC SEMARANG', 0.00, 0.00, 0.00, 0.00, 0),
(9, '121', 'DC HALIM', 0.00, 0.00, 0.00, 0.00, 0),
(10, '150', 'FULFILLMENT CENTER, GRAHA INTIRUB JAKARTA', 0.00, 0.00, 0.00, 0.00, 0),
(11, '151', 'ONLINE STORE SURABAYA', 0.00, 0.00, 0.00, 0.00, 0),
(12, '152', 'ONLINE STORE BANDUNG', 0.00, 0.00, 0.00, 0.00, 0),
(13, '153', 'ONLINE STORE BALIKPAPAN', 0.00, 0.00, 0.00, 0.00, 0),
(14, '154', 'ONLINE STORE BALI', 0.00, 0.00, 0.00, 0.00, 0),
(15, '155', 'ONLINE STORE MEDAN', 0.00, 0.00, 0.00, 0.00, 0),
(16, '156', 'ONLINE STORE MAKASAR', 0.00, 0.00, 0.00, 0.00, 0),
(17, '215', 'MDS KRAMAT JATI', 0.00, 0.00, 0.00, 0.00, 0),
(18, '217', 'GALLERIA PSR BARU', 0.00, 0.00, 0.00, 0.00, 0),
(19, '219', 'MDS CIMANGIS MALL', 0.00, 0.00, 0.00, 0.00, 0),
(20, '221', 'MDS Mall Panakukkang 2', 0.00, 0.00, 0.00, 0.00, 0),
(21, '223', 'MDS BATU MALANG', 0.00, 0.00, 0.00, 0.00, 0),
(22, '227', 'MDS SIDOARJO', 0.00, 0.00, 0.00, 0.00, 0),
(23, '233', 'MDS BANGKALAN MADURA', 0.00, 0.00, 0.00, 0.00, 0),
(24, '235', 'MDS.KENDARI MALL', 0.00, 0.00, 0.00, 0.00, 0),
(25, '239', 'MDS MALL CIPUTRA CIBUBUR', 0.00, 0.00, 0.00, 0.00, 0),
(26, '241', 'MDS BIG CTIY', 0.00, 0.00, 0.00, 0.00, 0),
(27, '243', 'MDS Cibubur', 0.00, 0.00, 0.00, 0.00, 0),
(28, '245', 'MDS CBD CILEDUG', 0.00, 0.00, 0.00, 0.00, 0),
(29, '249', 'MDS HARTONO SOLO', 0.00, 0.00, 0.00, 0.00, 0),
(30, '251', 'MDS TRADE WORLD BOGOR', 0.00, 0.00, 0.00, 0.00, 0),
(31, '252', 'MDS PASSO AMBON', 0.00, 0.00, 0.00, 0.00, 0),
(32, '253', 'MDS MEGA TOWN SQUARE', 0.00, 0.00, 0.00, 0.00, 0),
(33, '254', 'MDS CIBINONG BOGOR', 0.00, 0.00, 0.00, 0.00, 0),
(34, '255', 'MDS Town square Malang', 0.00, 0.00, 0.00, 0.00, 0),
(35, '256', 'MDS KAZA CITY MALL', 0.00, 0.00, 0.00, 0.00, 0),
(36, '257', 'MDS METROPOLIS', 0.00, 0.00, 0.00, 0.00, 0),
(37, '258', 'MDS MANDAU CITY SQUARE', 0.00, 0.00, 0.00, 0.00, 0),
(38, '259', 'MDS PASAR BESAR MALANG', 0.00, 0.00, 0.00, 0.00, 0),
(39, '261', 'MDS MEDAN FAIR', 0.00, 0.00, 0.00, 0.00, 0),
(40, '263', 'MDS MEGA MALL MENADO', 0.00, 0.00, 0.00, 0.00, 0),
(41, '264', 'MDS PALU GRAND MALL', 0.00, 0.00, 0.00, 0.00, 0),
(42, '266', 'MDS ST. MORITZ MALL', 0.00, 0.00, 0.00, 0.00, 0),
(43, '267', 'MDS Ciputra Seraya Pekanbaru', 0.00, 0.00, 0.00, 0.00, 0),
(44, '269', 'MDS TOWN SQUARE DEPOK', 0.00, 0.00, 0.00, 0.00, 0),
(45, '273', 'MDS SKA Pekanbaru', 0.00, 0.00, 0.00, 0.00, 0),
(46, '275', 'MDS Megamall Batam Centre', 0.00, 0.00, 0.00, 0.00, 0),
(47, '277', 'MDS ISTANA PLAZA BANDUNG', 0.00, 0.00, 0.00, 0.00, 0),
(48, '281', 'MDS BRILIANT KENDARI', 0.00, 0.00, 0.00, 0.00, 0),
(49, '283', 'MDS Mall Achmad Yani Pontianak', 0.00, 0.00, 0.00, 0.00, 0),
(50, '284', 'MDS QMALL BANJARMASIN', 0.00, 0.00, 0.00, 0.00, 0),
(51, '285', 'MDS Grand Palladium Medan', 0.00, 0.00, 0.00, 0.00, 0),
(52, '287', 'MDS NG RATU INDAH', 0.00, 0.00, 0.00, 0.00, 0),
(53, '288', 'MDS JAKABARING PALEMBANG', 0.00, 0.00, 0.00, 0.00, 0),
(54, '289', 'MDS PARAGON CITY', 0.00, 0.00, 0.00, 0.00, 0),
(55, '290', 'MDS PALOPO CITY MARKET', 0.00, 0.00, 0.00, 0.00, 0),
(56, '293', 'MDS ROYAL PLZ SBY', 0.00, 0.00, 0.00, 0.00, 0),
(57, '294', 'MDS JOGJA CITY MALL', 0.00, 0.00, 0.00, 0.00, 0),
(58, '296', 'MDS SERANG LAND', 0.00, 0.00, 0.00, 0.00, 0),
(59, '298', 'MDS KALIBATA MALL', 0.00, 0.00, 0.00, 0.00, 0),
(60, '299', 'MDS MAYOFIELD CILEGON', 0.00, 0.00, 0.00, 0.00, 0),
(61, '303', 'MDS SOLO SQUARE', 0.00, 0.00, 0.00, 0.00, 0),
(62, '305', 'MDS BATAM NAGOYA', 0.00, 0.00, 0.00, 0.00, 0),
(63, '306', 'MDS LIPPO JOGAJ MALL', 0.00, 0.00, 0.00, 0.00, 0),
(64, '307', 'MDS MAYOFIELD SUKABUMI', 0.00, 0.00, 0.00, 0.00, 0),
(65, '309', 'MDS BINJAI', 0.00, 0.00, 0.00, 0.00, 0),
(66, '311', 'MDS DUTA MALL BANJARMASIN', 0.00, 0.00, 0.00, 0.00, 0),
(67, '313', 'MDS NG PEJATEN', 0.00, 0.00, 0.00, 0.00, 0),
(68, '314', 'MDS LOMBOK EPICENTRUM', 0.00, 0.00, 0.00, 0.00, 0),
(69, '315', 'SM BOGOR', 0.00, 0.00, 0.00, 0.00, 0),
(70, '321', 'MDS MULIA SAMARINDA', 0.00, 0.00, 0.00, 0.00, 0),
(71, '323', 'MDS BLUE PLAZA BEKASI', 0.00, 0.00, 0.00, 0.00, 0),
(72, '327', 'MDS. BORNEO CITY SAMPIT', 0.00, 0.00, 0.00, 0.00, 0),
(73, '329', 'MDS Lippo Plaza Kupang', 0.00, 0.00, 0.00, 0.00, 0),
(74, '331', 'MDS. NG TAMAN ANGGREAK', 0.00, 0.00, 0.00, 0.00, 0),
(75, '332', 'MDS GAJAH MADA PLAZA', 0.00, 0.00, 0.00, 0.00, 0),
(76, '333', 'MDS MANADO TOWN SQUARE', 0.00, 0.00, 0.00, 0.00, 0),
(77, '337', 'MDS BASKO PADANG', 0.00, 0.00, 0.00, 0.00, 0),
(78, '338', 'MDS. PALEMBANG VILLAGE', 0.00, 0.00, 0.00, 0.00, 0),
(79, '339', 'MDS ARTHA GADING', 0.00, 0.00, 0.00, 0.00, 0),
(80, '345', 'MDS CENTRAL LAMPUNG', 0.00, 0.00, 0.00, 0.00, 0),
(81, '347', 'MDS CITO SURABAYA', 0.00, 0.00, 0.00, 0.00, 0),
(82, '349', 'MDS NG PLUIT', 0.00, 0.00, 0.00, 0.00, 0),
(83, '350', 'MDS BENGKULU INDAH', 0.00, 0.00, 0.00, 0.00, 0),
(84, '351', 'MDS GORONTALO', 0.00, 0.00, 0.00, 0.00, 0),
(85, '353', 'MDS TAMAN PALEM', 0.00, 0.00, 0.00, 0.00, 0),
(86, '355', 'MDS BALIKPAPAN SUPERBLOCK', 0.00, 0.00, 0.00, 0.00, 0),
(87, '358', 'MDS. CIREBON SUPER BLOCK', 0.00, 0.00, 0.00, 0.00, 0),
(88, '359', 'MDS FESTIVAL BANDUNG', 0.00, 0.00, 0.00, 0.00, 0),
(89, '361', 'MDS KEPRI BATAM', 0.00, 0.00, 0.00, 0.00, 0),
(90, '367', 'MDS. JAYAPURA', 0.00, 0.00, 0.00, 0.00, 0),
(91, '368', 'MDS MAGELANG ARMADA', 0.00, 0.00, 0.00, 0.00, 0),
(92, '369', 'MDS HERMES ACEH', 0.00, 0.00, 0.00, 0.00, 0),
(93, '371', 'MDS PONDOK GEDE', 0.00, 0.00, 0.00, 0.00, 0),
(94, '373', 'MDS KTC KELAPA GADING', 0.00, 0.00, 0.00, 0.00, 0),
(95, '375', 'MDS EKALOKASARI', 0.00, 0.00, 0.00, 0.00, 0),
(96, '377', 'GTC TANJUNG BUNGA MAKASAR', 0.00, 0.00, 0.00, 0.00, 0),
(97, '379', 'MDS WTC SERPONG', 0.00, 0.00, 0.00, 0.00, 0),
(98, '381', 'MDS SINGOSAREN', 0.00, 0.00, 0.00, 0.00, 0),
(99, '389', 'JAVA SUPERMALL', 0.00, 0.00, 0.00, 0.00, 0),
(100, '405', 'MDS LEMBUSWANA SAMARINDA', 0.00, 0.00, 0.00, 0.00, 0),
(101, '409', 'MDS GRAND MALL BEKASI', 0.00, 0.00, 0.00, 0.00, 0),
(102, '413', 'MDS KEDIRI LAND', 0.00, 0.00, 0.00, 0.00, 0),
(103, '415', 'MDS MADIUN', 0.00, 0.00, 0.00, 0.00, 0),
(104, '417', 'MDS GRESIK', 0.00, 0.00, 0.00, 0.00, 0),
(105, '419', 'MDS PAKUWON SBY', 0.00, 0.00, 0.00, 0.00, 0),
(106, '423', 'MDS BALEKOTA TANGERANG', 0.00, 0.00, 0.00, 0.00, 0),
(107, '426', 'MDS TASIKMALAYA', 0.00, 0.00, 0.00, 0.00, 0),
(108, '441', 'MDS PONTIANAK', 0.00, 0.00, 0.00, 0.00, 0),
(109, '453', 'MDS LIPPO KARAWACI', 0.00, 0.00, 0.00, 0.00, 0),
(110, '457', 'GALLERIA SIMPANG SIUR BALI', 0.00, 0.00, 0.00, 0.00, 0),
(111, '467', 'MDS KARTINI LAMPUNG', 0.00, 0.00, 0.00, 0.00, 0),
(112, '471', 'MDS TOWN SQUARE CILANDAK', 0.00, 0.00, 0.00, 0.00, 0),
(113, '501', 'MDS DUTA PLAZA I', 0.00, 0.00, 0.00, 0.00, 0),
(114, '503', 'MDS MAGELANG', 0.00, 0.00, 0.00, 0.00, 0),
(115, '507', 'MDS INT\'L PLAZA PALEMBANG', 0.00, 0.00, 0.00, 0.00, 0),
(116, '511', 'MDS ARION', 0.00, 0.00, 0.00, 0.00, 0),
(117, '517', 'MDS SIMPANG LIMA SEMARANG', 0.00, 0.00, 0.00, 0.00, 0),
(118, '523', 'MDS TUNJUNGAN PLAZA', 0.00, 0.00, 0.00, 0.00, 0),
(119, '528', 'MDS SIDOARJO', 0.00, 0.00, 0.00, 0.00, 0),
(120, '529', 'MDS KING PLAZA BANDUNG', 0.00, 0.00, 0.00, 0.00, 0),
(121, '533', 'MDS MALIOBORO I', 0.00, 0.00, 0.00, 0.00, 0),
(122, '535', 'MDS KUDUS', 0.00, 0.00, 0.00, 0.00, 0),
(123, '537', 'MDS JOHAR PLAZA(JEMBER)', 0.00, 0.00, 0.00, 0.00, 0),
(124, '539', 'MDS GRAND MALL SOLO', 0.00, 0.00, 0.00, 0.00, 0),
(125, '545', 'MDS BALIKPAPAN', 0.00, 0.00, 0.00, 0.00, 0),
(126, '553', 'MDS MEDAN THAMRIN', 0.00, 0.00, 0.00, 0.00, 0),
(127, '555', 'MDS METROPOLITAN MALL BEKASI', 0.00, 0.00, 0.00, 0.00, 0),
(128, '559', 'MDS CILEGON', 0.00, 0.00, 0.00, 0.00, 0),
(129, '563', 'MDS MALIOBORO  II', 0.00, 0.00, 0.00, 0.00, 0),
(130, '567', 'GALERIA  DELTA SURABAYA', 0.00, 0.00, 0.00, 0.00, 0),
(131, '571', 'MDS CITRALAND', 0.00, 0.00, 0.00, 0.00, 0),
(132, '585', 'MDS KARAWANG', 0.00, 0.00, 0.00, 0.00, 0),
(133, '594', 'MDS MTC MANADO', 0.00, 0.00, 0.00, 0.00, 0),
(134, '595', 'GALERIA BANDUNG', 0.00, 0.00, 0.00, 0.00, 0),
(135, '597', 'MDS MAKASAR MALL', 0.00, 0.00, 0.00, 0.00, 0),
(136, '599', 'MDS BOULEVARD CENTER MENADO', 0.00, 0.00, 0.00, 0.00, 0),
(137, '617', 'MDS KUTA SQUARE', 0.00, 0.00, 0.00, 0.00, 0),
(138, '619', 'MDS KLATEN', 0.00, 0.00, 0.00, 0.00, 0),
(139, '637', 'GALLERIA  BLOK M', 0.00, 0.00, 0.00, 0.00, 0),
(140, '639', 'MDS LUCKY BATAM', 0.00, 0.00, 0.00, 0.00, 0),
(141, '641', 'MDS PLAZA CITRA PAKANBARU', 0.00, 0.00, 0.00, 0.00, 0),
(142, '643', 'MDS AMBON', 0.00, 0.00, 0.00, 0.00, 0),
(143, '645', 'MDS MEDAN MALL', 0.00, 0.00, 0.00, 0.00, 0),
(144, '649', 'GALERIA YOGYA', 0.00, 0.00, 0.00, 0.00, 0),
(145, '653', 'MDS LIPO CIKARANG', 0.00, 0.00, 0.00, 0.00, 0),
(146, '655', 'MDS ATRIUM', 0.00, 0.00, 0.00, 0.00, 0),
(147, '663', 'MDS KLENDER', 0.00, 0.00, 0.00, 0.00, 0),
(148, '671', 'MDS ANGSUDUO JAMBI', 0.00, 0.00, 0.00, 0.00, 0),
(149, '673', 'MDS DAAN MOGOT', 0.00, 0.00, 0.00, 0.00, 0),
(150, '677', 'MDS GRAGE MALL CIREBON', 0.00, 0.00, 0.00, 0.00, 0),
(151, '697', 'MDS PEKALONGAN', 0.00, 0.00, 0.00, 0.00, 0),
(152, '804', 'SE PURWOKERTO', 0.00, 0.00, 0.00, 0.00, 0),
(153, '901', 'HEAD OFFICE', 0.00, 0.00, 0.00, 0.00, 0),
(154, '904', 'TWINNING', 0.00, 0.00, 0.00, 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id_driver` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` char(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_tlp` varchar(13) NOT NULL,
  `sim1` varchar(20) NOT NULL,
  `sim2` varchar(20) NOT NULL,
  `masa_berlaku1` date NOT NULL,
  `masa_berlaku2` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `pendidikan` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id_driver`, `nik`, `nama`, `alamat`, `tgl_lahir`, `no_tlp`, `sim1`, `sim2`, `masa_berlaku1`, `masa_berlaku2`, `tgl_masuk`, `pendidikan`, `status`, `id_user`, `hub`) VALUES
(11, '111', 'Romi', 'asd', '2020-05-10', '2134', '213123', '', '2020-05-10', '1970-01-01', '2020-05-10', 'SD', 1, 16, 4),
(12, '22222', 'Suwandi', 'asd', '2020-05-10', '213', '213123', '', '2020-05-11', '1970-01-01', '2020-05-11', 'SD', 1, 13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ikhtisar_detail`
--

CREATE TABLE `ikhtisar_detail` (
  `id_ikhtisar_detail` int(11) NOT NULL,
  `id_ikhtisar` int(11) NOT NULL,
  `idlokasi` int(11) NOT NULL,
  `idkasbank` int(11) NOT NULL,
  `cashbankno` varchar(128) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `id_transaksi_dept` varchar(128) NOT NULL,
  `pemohon` varchar(128) NOT NULL,
  `keperluan` varchar(128) NOT NULL,
  `catatan` varchar(128) NOT NULL,
  `total` float(10,2) NOT NULL,
  `status` int(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ikhtisar_detail`
--

INSERT INTO `ikhtisar_detail` (`id_ikhtisar_detail`, `id_ikhtisar`, `idlokasi`, `idkasbank`, `cashbankno`, `tgl_pengajuan`, `id_transaksi_dept`, `pemohon`, `keperluan`, `catatan`, `total`, `status`, `id_user`, `hub`) VALUES
(127, 111, 4, 385, 'KK-00000001', '2020-04-22', 'a:1:{i:0;s:3:\"210\";}', 'Friski', 'BS-00000001: sadasdasd', 'BS-00000001: sadasdasd', 500000.00, 1, 13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ikhtisar_header`
--

CREATE TABLE `ikhtisar_header` (
  `id_ikhtisar` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `no_ikhtisar` varchar(128) NOT NULL,
  `tgl_ikhtisar` date NOT NULL,
  `tgl_proses_ho` date NOT NULL,
  `status` int(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ikhtisar_header`
--

INSERT INTO `ikhtisar_header` (`id_ikhtisar`, `id_lokasi`, `no_ikhtisar`, `tgl_ikhtisar`, `tgl_proses_ho`, `status`, `id_user`, `hub`) VALUES
(111, 4, 'Ikh-00000001', '2020-04-22', '2020-04-22', 1, 13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `jenismobil`
--

CREATE TABLE `jenismobil` (
  `idjenismobil` int(11) NOT NULL,
  `jenismobil` varchar(30) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenismobil`
--

INSERT INTO `jenismobil` (`idjenismobil`, `jenismobil`, `id_user`, `hub`) VALUES
(2, 'a', 16, 0),
(3, 'x', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `ket` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `no_transaksi` varchar(15) NOT NULL,
  `nama_tabel` varchar(50) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `data_lama` varchar(200) NOT NULL,
  `data_baru` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`ket`, `datetime`, `no_transaksi`, `nama_tabel`, `user`, `data_lama`, `data_baru`) VALUES
('Insert data ke tabel transaksi_department, no_kas_bank = BC-005', '2019-10-24 05:09:16', '', '', 0, '0.00', '0.00'),
('Insert data ke tabel transaksi_department, no_kas_bank = BC-006', '2019-10-24 05:12:58', '', '', 0, '0.00', '0.00'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-005', '2019-10-24 06:55:35', 'BC-005', 'transaksi_department', NULL, '0.00', '0.00'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-006', '2019-10-24 07:10:40', 'BC-006', 'transaksi_department', NULL, '0.00', '0.00'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-007', '2019-10-24 07:30:34', 'BC-007', 'transaksi_department', NULL, '0.00', '1.00'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-008', '2019-10-24 07:31:06', 'BC-008', 'transaksi_department', NULL, '0.00', '1.00'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-009', '2019-10-24 07:31:25', 'BC-009', 'transaksi_department', NULL, '0.00', '1232323.00'),
('Insert data ke tabel supplier\r\n  , kode_suplier= fa', '2019-10-24 10:26:32', 'fa', 'supplier', 1, '0.00', '0.00'),
('Insert data ke tabel supplier\r\n  , kode_suplier= fas', '2019-10-24 10:27:17', 'fas', 'supplier', 1, '', 'kode_suplier=fasbank=1rekening=1kota=1cabang=1'),
('Update data ke tabel supplier\r\n  , kode_suplier= fas', '2019-10-24 10:30:56', 'fas', 'supplier', 2, '', 'kode_suplier=fasbank=2rekening=2kota=2cabang=2'),
('Update data ke tabel supplier\r\n  , kode_suplier= fas', '2019-10-24 10:36:40', 'fas', 'supplier', 2, 'kode_suplier=fasbank=2rekening=2kota=2cabang=2', 'kode_suplier=fasbank=2rekening=2kota=2cabang=2'),
('Update data ke tabel supplier\r\n  , kode_suplier= fas45645645645645', '2019-10-24 10:37:24', 'fas456456456456', 'supplier', 2, 'kode_suplier=fasbank=2rekening=2kota=2cabang=2', 'kode_suplier=fas45645645645645bank=2rekening=2kota=2cabang=2'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-001', '2019-10-25 08:02:41', 'BC-001', 'transaksi_department', NULL, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-002', '2019-10-25 09:52:46', 'BC-002', 'transaksi_department', NULL, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-003', '2019-10-25 14:26:38', 'BC-003', 'transaksi_department', NULL, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-10-29 05:16:56', 'Pettycash-0001', 'transaksi_detail', 0, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-10-29 06:02:20', 'Pettycash-0001', 'transaksi_detail', 0, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-004', '2019-10-29 07:15:39', 'BC-004', 'transaksi_department', NULL, '', '10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-01 04:10:19', 'Pettycash-0001', 'transaksi_detail', 0, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-06 02:28:47', 'Pettycash-0001', 'transaksi_detail', 0, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Cash-0002', '2019-11-07 05:08:54', 'Cash-0002', 'transaksi_detail', 0, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0003', '2019-11-07 05:09:57', 'Pettycash-0003', 'transaksi_detail', 0, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Cash-0004', '2019-11-07 05:11:52', 'Cash-0004', 'transaksi_detail', 0, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-001', '2019-11-11 02:07:30', 'BC-001', 'transaksi_department', NULL, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-11 02:46:17', 'Pettycash-0001', 'transaksi_detail', 0, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-001', '2019-11-11 02:50:49', 'BC-001', 'transaksi_department', NULL, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-002', '2019-11-11 02:51:07', 'BC-002', 'transaksi_department', NULL, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-003', '2019-11-11 07:32:13', 'BC-003', 'transaksi_department', NULL, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-004', '2019-11-11 15:28:13', 'BC-004', 'transaksi_department', NULL, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-001', '2019-11-12 03:47:04', 'BC-001', 'transaksi_department', NULL, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-002', '2019-11-12 03:47:43', 'BC-002', 'transaksi_department', NULL, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-001', '2019-11-12 03:57:00', 'BC-001', 'transaksi_department', NULL, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-12 03:59:23', 'Pettycash-0001', 'transaksi_detail', 0, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-13 02:07:41', 'Pettycash-0001', 'transaksi_detail', 0, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Cash-0001', '2019-11-13 04:19:51', 'Cash-0001', 'transaksi_detail', 0, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0002', '2019-11-13 04:21:09', 'Pettycash-0002', 'transaksi_detail', 0, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0002', '2019-11-13 07:31:42', 'Pettycash-0002', 'transaksi_detail', 0, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0002', '2019-11-13 07:31:55', 'Pettycash-0002', 'transaksi_detail', 0, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0002', '2019-11-13 07:32:01', 'Pettycash-0002', 'transaksi_detail', 0, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-13 07:33:37', 'Pettycash-0001', 'transaksi_detail', 0, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-002', '2019-11-13 08:01:34', 'BC-002', 'transaksi_department', NULL, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-001', '2019-11-13 08:03:28', 'BC-001', 'transaksi_department', NULL, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-002', '2019-11-13 08:03:45', 'BC-002', 'transaksi_department', NULL, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-13 08:22:24', 'Pettycash-0001', 'transaksi_detail', 0, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-13 08:24:04', 'Pettycash-0001', 'transaksi_detail', 0, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-13 08:27:00', 'Pettycash-0001', 'transaksi_detail', 0, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-13 08:27:09', 'Pettycash-0001', 'transaksi_detail', 0, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-003', '2019-11-13 08:32:58', 'BC-003', 'transaksi_department', NULL, '', '3000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0002', '2019-11-13 09:13:39', 'Pettycash-0002', 'transaksi_detail', 0, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Cash-0003', '2019-11-14 01:31:24', 'Cash-0003', 'transaksi_detail', 0, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0002', '2019-11-14 02:31:43', 'Pettycash-0002', 'transaksi_detail', 0, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0002', '2019-11-14 02:32:55', 'Pettycash-0002', 'transaksi_detail', 0, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-001', '2019-11-14 03:09:03', 'BC-001', 'transaksi_department', NULL, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-14 03:12:18', 'Pettycash-0001', 'transaksi_detail', 0, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-14 03:12:43', 'Pettycash-0001', 'transaksi_detail', 0, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-14 03:20:10', 'Pettycash-0001', 'transaksi_detail', 0, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-14 03:25:07', 'Pettycash-0001', 'transaksi_detail', 0, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = Pettycash-0001', '2019-11-14 03:36:56', 'Pettycash-0001', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-002', '2019-11-15 04:16:57', 'BC-002', 'transaksi_department', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-003', '2019-11-15 04:22:17', 'BC-003', 'transaksi_department', 1, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-004', '2019-11-16 15:22:33', 'BC-004', 'transaksi_department', 1, '', '3000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-005', '2019-11-17 05:46:08', 'BC-005', 'transaksi_department', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = ', '2019-11-17 07:50:05', '', 'transaksi_detail', 1, '', '400000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 42', '2019-11-17 07:54:53', '42', 'transaksi_detail', 1, '', '400000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 42', '2019-11-17 07:54:53', '42', 'transaksi_detail', 1, '', '400000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 42', '2019-11-17 07:54:53', '42', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2019-11-17 10:26:19', '0', 'transaksi_detail', 1, '', '400000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2019-11-17 10:26:19', '0', 'transaksi_detail', 1, '', '400000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2019-11-17 10:26:19', '0', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 43', '2019-11-17 10:40:17', '43', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 43', '2019-11-17 10:40:17', '43', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 44', '2019-11-17 10:41:24', '44', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 44', '2019-11-17 10:41:24', '44', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 45', '2019-11-17 10:43:15', '45', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 45', '2019-11-17 10:43:15', '45', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 45', '2019-11-17 10:51:33', '45', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 45', '2019-11-17 10:51:33', '45', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 45', '2019-11-17 11:54:27', '45', 'transaksi_detail', 1, '', '600000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 45', '2019-11-17 11:54:27', '45', 'transaksi_detail', 1, '', '400000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 45', '2019-11-17 11:56:42', '45', 'transaksi_detail', 1, '', '600000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 45', '2019-11-17 11:56:42', '45', 'transaksi_detail', 1, '', '400000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 45', '2019-11-17 12:04:20', '45', 'transaksi_detail', 1, '', '600000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 45', '2019-11-17 12:04:20', '45', 'transaksi_detail', 1, '', '400000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 45', '2019-11-17 12:20:51', '45', 'transaksi_detail', 1, '', '600000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 45', '2019-11-17 12:20:51', '45', 'transaksi_detail', 1, '', '400000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-001', '2019-11-17 13:51:06', 'BC-001', 'transaksi_department', 1, '', '3000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-002', '2019-11-17 13:52:56', 'BC-002', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 47', '2019-11-18 01:51:41', '47', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 47', '2019-11-18 01:51:41', '47', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-001', '2019-11-19 01:39:41', 'BC-001', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-002', '2019-11-19 01:40:09', 'BC-002', 'transaksi_department', 1, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-003', '2019-11-19 01:40:50', 'BC-003', 'transaksi_department', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-003', '2019-11-19 01:41:53', 'BC-003', 'transaksi_department', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-004', '2019-11-19 01:46:33', 'BC-004', 'transaksi_department', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 66', '2019-11-19 09:51:23', '66', 'transaksi_detail', 1, '', '750000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 66', '2019-11-19 09:51:23', '66', 'transaksi_detail', 1, '', '750000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 66', '2019-11-19 14:31:30', '66', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 66', '2019-11-19 14:55:31', '66', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 66', '2019-11-19 15:02:18', '66', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 66', '2019-11-19 15:03:13', '66', 'transaksi_detail', 1, '', '750000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 66', '2019-11-19 15:03:13', '66', 'transaksi_detail', 1, '', '750000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 66', '2019-11-19 15:04:03', '66', 'transaksi_detail', 1, '', '750000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 66', '2019-11-19 15:04:03', '66', 'transaksi_detail', 1, '', '750000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 66', '2019-11-19 15:04:38', '66', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 67', '2019-11-19 15:12:46', '67', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 67', '2019-11-19 15:12:46', '67', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 68', '2019-11-19 15:14:04', '68', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 69', '2019-11-19 15:14:57', '69', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 70', '2019-11-19 15:16:03', '70', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 70', '2019-11-19 15:16:03', '70', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 70', '2019-11-19 15:18:34', '70', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 70', '2019-11-19 15:18:34', '70', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 70', '2019-11-19 15:18:41', '70', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 70', '2019-11-19 15:18:41', '70', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 70', '2019-11-19 15:19:42', '70', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 70', '2019-11-19 15:19:42', '70', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 71', '2019-11-19 15:20:41', '71', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-005', '2019-11-19 15:36:30', 'BC-005', 'transaksi_department', 1, '', '5000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = BC-001', '2019-11-21 04:06:21', 'BC-001', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-21 04:49:57', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-21 06:25:25', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-21 06:26:35', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 72', '2019-11-21 09:58:23', '72', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-22 01:27:15', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 73', '2019-11-22 01:51:26', '73', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 73', '2019-11-22 01:51:26', '73', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 75', '2019-11-22 03:52:51', '75', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 76', '2019-11-22 04:48:33', '76', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 76', '2019-11-22 04:57:36', '76', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-22 06:54:55', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-22 09:02:57', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 77', '2019-11-22 12:34:15', '77', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 77', '2019-11-22 12:35:01', '77', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 79', '2019-11-22 15:40:43', '79', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 80', '2019-11-22 15:41:24', '80', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 81', '2019-11-22 15:41:57', '81', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 81', '2019-11-22 15:41:57', '81', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 82', '2019-11-22 16:04:21', '82', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 82', '2019-11-22 16:04:21', '82', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 83', '2019-11-22 16:11:46', '83', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 84', '2019-11-22 16:13:09', '84', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 85', '2019-11-22 16:17:51', '85', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 86', '2019-11-22 16:18:19', '86', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 88', '2019-11-22 16:35:32', '88', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 89', '2019-11-22 16:37:54', '89', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 91', '2019-11-22 16:38:30', '91', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 92', '2019-11-22 16:39:37', '92', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 93', '2019-11-22 16:42:35', '93', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-25 01:36:41', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 94', '2019-11-25 01:42:46', '94', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 95', '2019-11-25 01:56:02', '95', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 96', '2019-11-25 01:57:59', '96', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 97', '2019-11-25 02:02:27', '97', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 98', '2019-11-25 02:16:15', '98', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-25 03:15:38', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-25 07:49:26', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-25 09:25:57', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-25 09:30:53', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-25 09:35:23', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-26 14:42:59', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-26 14:44:40', '', 'transaksi_department', 1, '', '3000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-26 15:48:08', '', 'transaksi_department', 1, '', '3000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-27 01:34:42', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 99', '2019-11-27 02:21:03', '99', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 99', '2019-11-27 02:21:03', '99', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 100', '2019-11-27 03:04:42', '100', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 100', '2019-11-27 03:04:42', '100', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 101', '2019-11-27 03:06:11', '101', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 101', '2019-11-27 03:06:11', '101', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-27 08:50:58', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 102', '2019-11-27 08:52:01', '102', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-27 10:48:15', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-27 10:49:15', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 103', '2019-11-27 10:50:12', '103', 'transaksi_detail', 1, '', '1500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-11-28 02:19:37', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 104', '2019-11-28 02:52:03', '104', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 104', '2019-11-28 02:52:03', '104', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-01 03:44:41', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 105', '2019-12-01 04:29:11', '105', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-01 06:01:22', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 106', '2019-12-01 11:31:02', '106', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-01 13:11:01', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 107', '2019-12-01 13:13:01', '107', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-01 13:15:51', '', 'transaksi_department', 1, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-01 14:26:43', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 108', '2019-12-01 14:28:13', '108', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 109', '2019-12-01 15:25:38', '109', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-02 03:14:51', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 110', '2019-12-02 15:59:32', '110', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 110', '2019-12-02 16:12:01', '110', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 110', '2019-12-05 03:56:10', '110', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-05 04:00:08', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 111', '2019-12-05 04:07:59', '111', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 111', '2019-12-05 15:02:48', '111', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-06 03:01:14', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 112', '2019-12-06 03:03:15', '112', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 112', '2019-12-06 03:22:52', '112', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-06 08:11:02', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 113', '2019-12-06 08:12:24', '113', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 113', '2019-12-09 02:06:25', '113', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-09 02:22:03', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-09 03:25:18', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 114', '2019-12-10 08:10:23', '114', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-10 10:52:25', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-11 04:37:02', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-11 05:21:12', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 115', '2019-12-11 07:50:57', '115', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-11 16:16:21', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 116', '2019-12-12 03:12:13', '116', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-12 03:19:09', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-12 06:30:17', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-16 01:56:02', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-16 02:58:36', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 117', '2019-12-16 03:06:26', '117', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 117', '2019-12-16 03:06:26', '117', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 117', '2019-12-16 03:07:55', '117', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-16 03:33:03', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-16 04:11:46', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 118', '2019-12-16 08:53:20', '118', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-16 13:09:06', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-16 13:15:43', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-16 13:18:37', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-16 13:25:56', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-16 13:37:01', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 122', '2019-12-16 16:37:42', '122', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 123', '2019-12-16 16:52:09', '123', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 123', '2019-12-16 16:52:17', '123', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 123', '2019-12-16 16:53:28', '123', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 123', '2019-12-16 16:54:12', '123', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-16 17:18:26', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 124', '2019-12-16 17:19:08', '124', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-17 01:30:53', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-17 07:49:06', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-17 07:50:07', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-17 08:46:50', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-17 13:50:28', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-17 14:31:37', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-17 15:05:06', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 125', '2019-12-17 15:29:22', '125', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-17 15:31:24', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-17 15:42:13', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 126', '2019-12-17 16:11:45', '126', 'transaksi_detail', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 134', '2019-12-17 16:46:45', '134', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 135', '2019-12-17 16:47:46', '135', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 136', '2019-12-17 17:00:54', '136', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 01:41:16', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 137', '2019-12-18 02:06:38', '137', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 138', '2019-12-18 02:08:12', '138', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 138', '2019-12-18 02:08:12', '138', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 02:16:58', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 139', '2019-12-18 02:21:50', '139', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 02:55:11', '', 'transaksi_department', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 03:07:55', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 03:20:00', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 03:21:46', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 03:57:17', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 04:02:59', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 06:01:34', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 06:08:51', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 140', '2019-12-18 06:14:17', '140', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 06:28:12', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 08:01:46', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 08:31:20', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 08:47:08', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 09:10:53', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 141', '2019-12-18 10:07:07', '141', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 10:09:32', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 142', '2019-12-18 10:46:50', '142', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 10:50:24', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 143', '2019-12-18 10:52:27', '143', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 13:32:40', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 13:42:31', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 144', '2019-12-18 14:54:42', '144', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 14:57:58', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 15:03:26', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 15:10:26', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 145', '2019-12-18 15:12:26', '145', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 146', '2019-12-18 15:27:12', '146', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 15:32:36', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 15:37:30', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 15:40:18', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 147', '2019-12-18 15:57:53', '147', 'transaksi_detail', 1, '', '100000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 15:59:32', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 148', '2019-12-18 16:02:25', '148', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 16:10:32', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 149', '2019-12-18 17:01:39', '149', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 150', '2019-12-18 17:13:38', '150', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 17:20:31', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 151', '2019-12-18 17:22:02', '151', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 17:32:22', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 152', '2019-12-18 17:34:14', '152', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 17:41:41', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 153', '2019-12-18 17:43:17', '153', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-18 17:45:57', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 154', '2019-12-18 17:47:24', '154', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-19 17:04:12', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 155', '2019-12-19 17:23:38', '155', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 156', '2019-12-19 17:43:46', '156', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 157', '2019-12-19 17:45:02', '157', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-19 17:45:36', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 158', '2019-12-19 17:47:02', '158', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-19 17:51:25', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 159', '2019-12-19 17:53:20', '159', 'transaksi_detail', 1, '', '250000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-20 03:12:24', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 160', '2019-12-20 03:14:13', '160', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-20 03:19:49', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-20 03:31:30', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-20 09:31:14', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-20 09:34:49', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 161', '2019-12-20 09:39:29', '161', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 162', '2019-12-23 01:59:46', '162', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 164', '2019-12-23 02:17:36', '164', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 165', '2019-12-23 02:18:05', '165', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 167', '2019-12-23 02:43:26', '167', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 169', '2019-12-23 02:55:54', '169', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 170', '2019-12-23 03:01:24', '170', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 170', '2019-12-23 03:01:29', '170', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 170', '2019-12-23 03:01:45', '170', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 170', '2019-12-23 03:02:31', '170', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 171', '2019-12-23 03:06:01', '171', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 171', '2019-12-23 03:06:46', '171', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 171', '2019-12-23 03:07:31', '171', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 171', '2019-12-23 03:22:19', '171', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 172', '2019-12-23 03:23:43', '172', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 172', '2019-12-23 03:24:18', '172', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 173', '2019-12-23 03:27:50', '173', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 173', '2019-12-23 03:43:51', '173', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 173', '2019-12-23 03:47:27', '173', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 173', '2019-12-23 03:51:02', '173', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 173', '2019-12-23 03:52:36', '173', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 173', '2019-12-23 04:12:09', '173', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 173', '2019-12-23 04:46:33', '173', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 174', '2019-12-23 04:49:29', '174', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 174', '2019-12-23 04:50:01', '174', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 175', '2019-12-23 04:52:09', '175', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 175', '2019-12-23 04:52:38', '175', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 175', '2019-12-23 04:52:43', '175', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 175', '2019-12-23 04:56:31', '175', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 175', '2019-12-23 04:56:35', '175', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 176', '2019-12-23 05:37:03', '176', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 176', '2019-12-23 05:37:07', '176', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 176', '2019-12-23 05:37:10', '176', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 176', '2019-12-23 05:47:55', '176', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 176', '2019-12-23 05:49:26', '176', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 176', '2019-12-23 05:54:49', '176', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 176', '2019-12-23 05:54:53', '176', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-23 05:55:35', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 177', '2019-12-23 06:03:57', '177', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 177', '2019-12-23 06:04:02', '177', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 177', '2019-12-23 06:04:05', '177', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 176', '2019-12-23 06:04:08', '176', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-23 06:42:47', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 178', '2019-12-23 06:45:48', '178', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-23 06:47:13', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 179', '2019-12-23 06:48:53', '179', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 179', '2019-12-23 06:57:08', '179', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 180', '2019-12-23 06:59:42', '180', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 180', '2019-12-23 07:00:14', '180', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 180', '2019-12-23 07:07:53', '180', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-23 07:30:53', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 189', '2019-12-23 10:00:36', '189', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 190', '2019-12-23 10:03:48', '190', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 191', '2019-12-23 10:05:54', '191', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 191', '2019-12-23 10:24:40', '191', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 191', '2019-12-23 10:25:07', '191', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 191', '2019-12-23 10:26:54', '191', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 191', '2019-12-23 10:29:32', '191', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 192', '2019-12-23 10:30:21', '192', 'transaksi_detail', 1, '', '2000000');
INSERT INTO `log` (`ket`, `datetime`, `no_transaksi`, `nama_tabel`, `user`, `data_lama`, `data_baru`) VALUES
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 192', '2019-12-23 10:30:39', '192', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 192', '2019-12-23 10:33:20', '192', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 192', '2019-12-23 10:35:00', '192', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 192', '2019-12-23 10:35:11', '192', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 192', '2019-12-23 10:35:24', '192', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 192', '2019-12-23 10:35:29', '192', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 192', '2019-12-23 10:36:37', '192', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 192', '2019-12-23 10:36:46', '192', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 180', '2019-12-23 14:19:04', '180', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 180', '2019-12-23 14:20:33', '180', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 180', '2019-12-23 14:22:37', '180', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-23 14:26:09', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-23 14:29:48', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 193', '2019-12-23 14:35:51', '193', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-23 14:45:03', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 194', '2019-12-23 14:46:39', '194', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 194', '2019-12-23 14:48:18', '194', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-23 14:49:28', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 195', '2019-12-23 14:51:03', '195', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-23 14:53:47', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 196', '2019-12-23 14:55:27', '196', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 194', '2019-12-23 14:56:26', '194', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 195', '2019-12-23 14:56:29', '195', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 196', '2019-12-23 14:56:35', '196', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 194', '2019-12-23 14:56:38', '194', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 195', '2019-12-23 15:43:25', '195', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 196', '2019-12-23 15:44:04', '196', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 196', '2019-12-23 16:09:21', '196', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-23 16:10:09', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 197', '2019-12-23 16:11:00', '197', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 198', '2019-12-23 16:38:20', '198', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 198', '2019-12-23 16:43:37', '198', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 199', '2019-12-23 16:45:46', '199', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 199', '2019-12-23 16:48:26', '199', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 200', '2019-12-23 16:51:23', '200', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 200', '2019-12-23 16:54:55', '200', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 200', '2019-12-23 16:56:20', '200', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 200', '2019-12-23 16:57:58', '200', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 200', '2019-12-23 16:59:44', '200', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 200', '2019-12-23 16:59:49', '200', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 200', '2019-12-23 17:00:04', '200', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 200', '2019-12-23 17:08:14', '200', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 201', '2019-12-23 17:12:44', '201', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 201', '2019-12-23 17:12:47', '201', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 201', '2019-12-23 17:12:56', '201', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 201', '2019-12-23 17:13:06', '201', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 201', '2019-12-23 17:13:09', '201', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-24 03:04:16', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 202', '2019-12-26 06:27:21', '202', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2019-12-26 07:09:36', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 203', '2019-12-26 07:19:16', '203', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-02 01:33:33', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 204', '2020-01-02 01:41:05', '204', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 204', '2020-01-02 01:41:05', '204', 'transaksi_detail', 1, '', '500000'),
('Update data ke tabel supplier\r\n  , kode_suplier= SPL-001', '2020-01-02 07:08:54', 'SPL-001', 'supplier', 0, 'kode_suplier=SPL-001bank=bcarekening=123123123kota=medandddcabang=Medan', 'kode_suplier=SPL-001bank=bcarekening=123123123kota=medandddcabang=Medan'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-02 07:13:05', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-03 03:59:07', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-03 04:04:24', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 205', '2020-01-03 04:07:26', '205', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 205', '2020-01-03 04:07:26', '205', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 205', '2020-01-03 04:07:26', '205', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 205', '2020-01-03 04:07:26', '205', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-05 01:51:58', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 01:54:03', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 01:54:03', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 01:55:10', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 01:55:10', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 03:10:11', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 03:10:11', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:17:23', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:17:23', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:23:32', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:23:32', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:24:43', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:24:43', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:28:31', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:28:31', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:28:38', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:28:38', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:30:46', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:30:46', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:31:05', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 206', '2020-01-05 04:31:05', '206', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 207', '2020-01-05 04:32:10', '207', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 207', '2020-01-05 04:32:31', '207', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 207', '2020-01-05 04:34:20', '207', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 207', '2020-01-05 04:41:22', '207', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 207', '2020-01-05 05:02:15', '207', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 05:16:48', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 05:16:48', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 05:17:02', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 05:17:02', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 05:17:36', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 05:17:36', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 05:24:07', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 05:24:07', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 05:25:04', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 05:25:04', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 07:32:02', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 07:32:02', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 07:32:28', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 07:32:28', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 07:34:28', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 07:34:28', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 08:31:37', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 08:31:37', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 08:32:31', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 08:32:31', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 08:34:22', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 08:34:22', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 08:35:06', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 08:35:06', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 08:58:43', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 208', '2020-01-05 08:58:43', '208', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 209', '2020-01-05 17:35:59', '209', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 210', '2020-01-06 03:30:55', '210', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-09 03:00:41', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 212', '2020-01-13 03:48:57', '212', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 212', '2020-01-14 04:39:15', '212', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 212', '2020-01-14 04:39:15', '212', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 212', '2020-01-14 04:39:50', '212', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 212', '2020-01-14 04:39:50', '212', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 212', '2020-01-14 04:41:08', '212', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 212', '2020-01-14 04:41:08', '212', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 213', '2020-01-14 04:42:37', '213', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 214', '2020-01-14 04:46:52', '214', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 215', '2020-01-14 04:47:29', '215', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 216', '2020-01-14 10:07:01', '216', 'transaksi_detail', 1, '', '1500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 217', '2020-01-14 10:07:23', '217', 'transaksi_detail', 1, '', '1500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-14 16:34:32', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 218', '2020-01-14 16:36:00', '218', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 218', '2020-01-14 16:36:00', '218', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 219', '2020-01-14 17:07:37', '219', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 220', '2020-01-14 17:12:40', '220', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 221', '2020-01-14 17:19:28', '221', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 222', '2020-01-14 17:38:13', '222', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 223', '2020-01-14 17:40:09', '223', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 224', '2020-01-14 17:40:27', '224', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 225', '2020-01-14 17:40:47', '225', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 226', '2020-01-14 17:41:07', '226', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 227', '2020-01-14 17:47:10', '227', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 228', '2020-01-14 17:47:33', '228', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 229', '2020-01-14 17:49:47', '229', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 230', '2020-01-14 17:50:03', '230', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 231', '2020-01-14 17:50:19', '231', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 232', '2020-01-14 17:50:36', '232', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 233', '2020-01-14 17:52:56', '233', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 234', '2020-01-14 17:53:14', '234', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 235', '2020-01-14 17:53:32', '235', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 236', '2020-01-14 17:53:53', '236', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 237', '2020-01-14 17:54:52', '237', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 238', '2020-01-14 17:55:12', '238', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 239', '2020-01-14 17:55:33', '239', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 240', '2020-01-14 17:55:50', '240', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-15 01:22:26', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-15 01:28:24', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 241', '2020-01-15 01:33:01', '241', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 242', '2020-01-15 01:34:27', '242', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 243', '2020-01-15 01:35:11', '243', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 244', '2020-01-15 02:24:21', '244', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 245', '2020-01-15 02:24:38', '245', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 246', '2020-01-15 02:44:56', '246', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 247', '2020-01-15 02:45:28', '247', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 248', '2020-01-15 03:09:54', '248', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 248', '2020-01-15 03:11:28', '248', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 249', '2020-01-15 03:13:13', '249', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 249', '2020-01-15 03:17:40', '249', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 249', '2020-01-15 03:29:22', '249', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 250', '2020-01-15 03:32:06', '250', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 250', '2020-01-15 03:32:44', '250', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 250', '2020-01-15 03:33:07', '250', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 250', '2020-01-15 03:52:55', '250', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-15 04:13:28', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 251', '2020-01-15 04:14:52', '251', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 250', '2020-01-15 04:15:02', '250', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 251', '2020-01-15 04:15:27', '251', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 250', '2020-01-15 04:19:11', '250', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-15 04:24:26', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 252', '2020-01-15 04:25:48', '252', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 252', '2020-01-15 04:28:49', '252', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 252', '2020-01-15 04:30:37', '252', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 252', '2020-01-15 04:32:03', '252', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 252', '2020-01-15 04:36:39', '252', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 252', '2020-01-15 04:38:10', '252', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 252', '2020-01-15 04:41:12', '252', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-15 04:46:44', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 253', '2020-01-15 04:47:30', '253', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 253', '2020-01-15 04:47:34', '253', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 253', '2020-01-15 04:55:11', '253', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 255', '2020-01-16 15:27:33', '255', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 256', '2020-01-16 15:32:46', '256', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 257', '2020-01-16 16:00:44', '257', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-16 16:01:23', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 258', '2020-01-16 16:02:13', '258', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 259', '2020-01-17 01:43:00', '259', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 260', '2020-01-17 01:45:05', '260', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 261', '2020-01-17 01:46:33', '261', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 268', '2020-01-17 04:58:13', '268', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 268', '2020-01-17 04:58:13', '268', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 268', '2020-01-18 23:57:24', '268', 'transaksi_detail', 0, '', '8000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 268', '2020-01-19 00:01:06', '268', 'transaksi_detail', 0, '', '8000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 268', '2020-01-19 00:07:22', '268', 'transaksi_detail', 0, '', '8000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 268', '2020-01-19 00:10:16', '268', 'transaksi_detail', 0, '', '-8000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 268', '2020-01-19 00:37:23', '268', 'transaksi_detail', 0, '', '-8000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 268', '2020-01-19 01:24:42', '268', 'transaksi_detail', 0, '', '-8000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 269', '2020-01-19 01:49:07', '269', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 270', '2020-01-19 02:08:34', '270', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 271', '2020-01-19 05:54:05', '271', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 272', '2020-01-19 06:08:58', '272', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 273', '2020-01-19 06:10:31', '273', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 274', '2020-01-19 06:11:36', '274', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 275', '2020-01-19 07:41:32', '275', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 276', '2020-01-19 10:58:02', '276', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 277', '2020-01-19 12:29:42', '277', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 278', '2020-01-19 12:40:50', '278', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 279', '2020-01-19 15:45:58', '279', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 278', '2020-01-19 16:06:22', '278', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 280', '2020-01-19 16:21:44', '280', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 280', '2020-01-19 16:22:01', '280', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 281', '2020-01-19 16:29:47', '281', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 282', '2020-01-19 16:30:09', '282', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 283', '2020-01-19 16:31:24', '283', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 284', '2020-01-19 16:33:17', '284', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 285', '2020-01-19 16:34:40', '285', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 286', '2020-01-19 16:35:24', '286', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 287', '2020-01-19 16:35:56', '287', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 288', '2020-01-19 16:40:25', '288', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 289', '2020-01-19 16:40:42', '289', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 289', '2020-01-19 16:40:42', '289', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 290', '2020-01-19 16:41:23', '290', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 290', '2020-01-19 16:41:23', '290', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 291', '2020-01-19 16:44:05', '291', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 291', '2020-01-19 16:44:05', '291', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 16:45:15', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 16:45:15', '292', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 16:50:51', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 16:53:49', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 16:53:49', '292', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 16:53:56', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 16:54:35', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 16:54:35', '292', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 16:55:15', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 16:55:15', '292', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 16:55:55', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 16:56:07', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 16:56:07', '292', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:27:01', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:28:07', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:28:07', '292', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:28:11', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:28:11', '292', 'transaksi_detail', 1, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:28:11', '292', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:28:53', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:28:53', '292', 'transaksi_detail', 1, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:28:53', '292', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:29:20', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:29:20', '292', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:32:06', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:32:06', '292', 'transaksi_detail', 1, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:32:06', '292', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:32:25', '292', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:32:25', '292', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:32:52', '292', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:32:52', '292', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:34:00', '292', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:34:00', '292', 'transaksi_detail', 0, '', '-50000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:37:13', '292', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:37:13', '292', 'transaksi_detail', 0, '', '-50000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:38:44', '292', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:38:44', '292', 'transaksi_detail', 1, '', '-50000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:38:44', '292', 'transaksi_detail', 0, '', '-50000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:39:08', '292', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 292', '2020-01-19 17:39:08', '292', 'transaksi_detail', 0, '', '-50000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 293', '2020-01-19 17:40:17', '293', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 293', '2020-01-19 17:40:54', '293', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 294', '2020-01-19 17:46:28', '294', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 295', '2020-01-19 17:48:18', '295', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 296', '2020-01-19 17:48:54', '296', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 297', '2020-01-19 17:49:07', '297', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 298', '2020-01-19 17:52:27', '298', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 298', '2020-01-19 17:52:27', '298', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 299', '2020-01-19 17:52:58', '299', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 300', '2020-01-19 17:53:14', '300', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 301', '2020-01-19 17:56:26', '301', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 302', '2020-01-19 17:56:29', '302', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 303', '2020-01-19 17:59:12', '303', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-19 17:59:12', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:00:09', '304', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-19 18:00:09', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:00:16', '304', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:00:47', '304', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:05:22', '304', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-19 18:05:22', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 305', '2020-01-19 18:10:16', '305', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-19 18:10:16', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 305', '2020-01-19 18:10:59', '305', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-19 18:10:59', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 305', '2020-01-19 18:12:43', '305', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-19 18:12:43', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:14:01', '304', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-19 18:14:01', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:14:20', '304', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-19 18:14:20', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:14:41', '304', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:14:41', '304', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:17:43', '304', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:17:43', '304', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:17:43', '304', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:17:56', '304', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:17:56', '304', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:17:56', '304', 'transaksi_detail', 1, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:17:56', '304', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:17:56', '304', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-19 18:17:56', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-19 18:17:56', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:18:55', '304', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 304', '2020-01-19 18:18:55', '304', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-19 18:18:55', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 01:37:12', '306', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 01:37:12', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:05:05', '306', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:05:05', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:15:25', '306', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:15:25', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:12', '306', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:12', '306', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:16:12', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:19', '306', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:20', '306', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:20', '306', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:16:20', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:20', '306', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:16:20', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:16:20', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:31', '306', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:31', '306', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:16:31', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:38', '306', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:38', '306', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:38', '306', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:16:38', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:38', '306', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:16:38', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:16:38', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:50', '306', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 306', '2020-01-20 03:16:50', '306', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:16:50', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 307', '2020-01-20 03:22:14', '307', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:22:14', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 307', '2020-01-20 03:22:22', '307', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:22:22', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 307', '2020-01-20 03:33:14', '307', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 307', '2020-01-20 03:33:14', '307', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:33:14', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 307', '2020-01-20 03:33:27', '307', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 307', '2020-01-20 03:33:27', '307', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 307', '2020-01-20 03:33:27', '307', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:33:27', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 307', '2020-01-20 03:33:27', '307', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:33:27', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:33:27', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 307', '2020-01-20 03:35:37', '307', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 307', '2020-01-20 03:35:37', '307', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:35:37', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 307', '2020-01-20 03:36:13', '307', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 307', '2020-01-20 03:36:13', '307', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:36:13', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 308', '2020-01-20 03:38:03', '308', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 309', '2020-01-20 03:39:46', '309', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 308', '2020-01-20 03:39:56', '308', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 308', '2020-01-20 03:39:56', '308', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:39:56', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 310', '2020-01-20 03:40:34', '310', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:40:34', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 311', '2020-01-20 03:41:01', '311', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 312', '2020-01-20 03:41:20', '312', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 313', '2020-01-20 03:47:10', '313', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 313', '2020-01-20 03:47:10', '313', 'transaksi_detail', 0, '', '-20000');
INSERT INTO `log` (`ket`, `datetime`, `no_transaksi`, `nama_tabel`, `user`, `data_lama`, `data_baru`) VALUES
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 314', '2020-01-20 03:47:35', '314', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 314', '2020-01-20 03:47:58', '314', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 314', '2020-01-20 03:47:58', '314', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 0', '2020-01-20 03:47:58', '0', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 315', '2020-01-20 03:51:57', '315', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 315', '2020-01-20 03:51:57', '315', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 316', '2020-01-20 03:52:54', '316', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 316', '2020-01-20 03:52:54', '316', 'transaksi_detail', 0, '', '10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 317', '2020-01-20 04:32:21', '317', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 318', '2020-01-20 04:32:48', '318', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 318', '2020-01-20 04:32:48', '318', 'transaksi_detail', 0, '', '-100000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 319', '2020-01-20 04:33:03', '319', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 319', '2020-01-20 04:33:03', '319', 'transaksi_detail', 0, '', '-100000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 320', '2020-01-20 04:34:03', '320', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 321', '2020-01-20 04:34:25', '321', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 322', '2020-01-20 04:34:55', '322', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 323', '2020-01-20 04:35:14', '323', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 323', '2020-01-20 04:35:14', '323', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 323', '2020-01-20 04:35:14', '323', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:35:55', '324', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:35:55', '324', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:35:55', '324', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:03', '324', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:03', '324', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:03', '324', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:08', '324', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:08', '324', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:08', '324', 'transaksi_detail', 1, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:08', '324', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:08', '324', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:08', '324', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:08', '324', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:08', '324', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:08', '324', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:24', '324', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:24', '324', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:24', '324', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:44', '324', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:44', '324', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:44', '324', 'transaksi_detail', 1, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:44', '324', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:44', '324', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:44', '324', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:44', '324', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:44', '324', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:45:44', '324', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:46:02', '324', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:46:02', '324', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:46:02', '324', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:46:44', '324', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:46:44', '324', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:46:44', '324', 'transaksi_detail', 1, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:47:57', '324', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:47:57', '324', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:47:57', '324', 'transaksi_detail', 1, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:47:57', '324', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:47:57', '324', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:48:23', '324', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:48:37', '324', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 324', '2020-01-20 04:48:52', '324', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 325', '2020-01-20 04:52:04', '325', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 326', '2020-01-20 04:53:29', '326', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 327', '2020-01-20 04:55:42', '327', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 328', '2020-01-20 05:01:25', '328', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 329', '2020-01-20 05:02:22', '329', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 329', '2020-01-20 05:02:22', '329', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 330', '2020-01-20 05:03:30', '330', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 331', '2020-01-20 05:04:01', '331', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 332', '2020-01-20 05:05:41', '332', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 332', '2020-01-20 05:05:41', '332', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 333', '2020-01-20 05:07:04', '333', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 334', '2020-01-20 05:07:49', '334', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 334', '2020-01-20 05:07:49', '334', 'transaksi_detail', 0, '', '100'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 335', '2020-01-20 05:09:09', '335', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 335', '2020-01-20 05:09:09', '335', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 336', '2020-01-20 05:11:49', '336', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 337', '2020-01-20 05:12:02', '337', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 338', '2020-01-20 05:12:22', '338', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 339', '2020-01-20 05:12:44', '339', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 339', '2020-01-20 05:12:44', '339', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 340', '2020-01-20 05:13:52', '340', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 340', '2020-01-20 05:13:52', '340', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 341', '2020-01-20 05:14:34', '341', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 341', '2020-01-20 05:14:34', '341', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 342', '2020-01-20 06:10:07', '342', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 342', '2020-01-20 06:10:07', '342', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 343', '2020-01-20 06:10:24', '343', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 344', '2020-01-20 06:11:12', '344', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 344', '2020-01-20 06:11:12', '344', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 344', '2020-01-20 06:11:12', '344', 'transaksi_detail', 0, '', '10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 345', '2020-01-20 06:13:16', '345', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 345', '2020-01-20 06:13:16', '345', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 346', '2020-01-20 06:13:46', '346', 'transaksi_detail', 1, '', '3500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 346', '2020-01-20 06:13:46', '346', 'transaksi_detail', 0, '', '-350000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 346', '2020-01-20 06:13:46', '346', 'transaksi_detail', 0, '', '35000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 347', '2020-01-20 06:14:16', '347', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 347', '2020-01-20 06:16:35', '347', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 345', '2020-01-20 06:16:40', '345', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 345', '2020-01-20 06:16:40', '345', 'transaksi_detail', 0, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 345', '2020-01-20 06:16:40', '345', 'transaksi_detail', 1, '', '5000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 348', '2020-01-20 06:20:34', '348', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 348', '2020-01-20 06:20:34', '348', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 349', '2020-01-20 06:22:58', '349', 'transaksi_detail', 1, '', '5000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 349', '2020-01-20 06:22:58', '349', 'transaksi_detail', 0, '', '-100000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 350', '2020-01-20 06:27:15', '350', 'transaksi_detail', 1, '', '2500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 350', '2020-01-20 06:27:15', '350', 'transaksi_detail', 0, '', '-100000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 350', '2020-01-20 06:27:15', '350', 'transaksi_detail', 0, '', '250000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 351', '2020-01-20 06:32:44', '351', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 351', '2020-01-20 06:32:44', '351', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:34:21', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:34:21', '352', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:38:54', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:38:54', '352', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:39:02', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:39:02', '352', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:39:02', '352', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:39:16', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:39:16', '352', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:41:03', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:41:03', '352', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:41:21', '352', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:41:21', '352', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:41:21', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:42:03', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:42:38', '352', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:42:38', '352', 'transaksi_detail', 0, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:42:56', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:42:56', '352', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:46:24', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:46:24', '352', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:46:24', '352', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:46:42', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:46:54', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:47:08', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 06:47:08', '352', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 353', '2020-01-20 06:57:54', '353', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 353', '2020-01-20 06:57:54', '353', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 07:08:23', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 07:08:23', '352', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 07:08:23', '352', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 07:08:30', '352', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 352', '2020-01-20 07:08:30', '352', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 353', '2020-01-20 07:18:25', '353', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 07:20:02', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 07:20:02', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 08:05:51', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 08:07:47', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 08:07:47', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:06:33', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:06:51', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:06:51', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:06:51', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:06:58', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:06:58', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:07:04', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:07:04', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:07:04', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:07:11', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:07:11', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:08:01', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:08:01', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:08:01', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:08:18', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:08:18', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:10:52', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:10:52', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:11:38', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:11:38', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:12:20', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:12:20', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:12:29', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:14:05', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:14:05', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:14:10', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:14:10', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:14:10', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:14:14', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:14:14', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:14:35', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:14:35', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:14:35', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:15:04', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:15:04', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:15:24', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:15:24', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:16:58', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:16:58', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:17:02', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:17:02', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:17:02', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:17:05', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:17:05', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:17:05', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:17:15', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:17:15', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:17:50', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:17:50', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:17:50', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:08', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:08', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:08', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:08', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:08', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:18', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:18', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:18', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:18', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:18', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:24', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:24', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:24', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:24', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:30', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:30', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:30', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:18:30', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:19:05', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:19:05', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:19:05', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:19:05', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:20', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:20', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:20', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:20', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:33', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:33', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:33', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:33', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:33', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:33', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:45', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:45', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:45', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:21:45', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:08', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:08', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:08', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:08', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:08', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:08', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:38', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:38', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:38', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:38', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:38', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:38', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:38', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:22:38', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:23:39', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:23:39', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:23:39', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:23:39', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:23:39', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:24:06', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:24:06', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:24:06', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:24:06', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:24:14', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:24:14', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:24:14', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:24:14', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:24:46', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:24:46', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:24:46', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:24:46', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:25:29', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:25:29', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:25:29', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:25:29', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:28:17', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:28:17', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:28:17', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:28:17', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:29:08', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:29:08', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:29:08', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:29:08', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:29:15', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:29:15', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:29:15', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:29:15', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:29:15', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:29:15', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:20', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:20', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:20', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:20', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:20', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:20', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:20', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:20', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:20', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:20', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:20', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:20', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:29', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:39', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:39', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:39', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:39', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:39', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:39', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:39', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:40:39', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:07', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:07', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:08', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:08', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:08', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:08', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:08', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:08', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:08', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:08', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:08', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:08', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:08', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:41:08', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:00', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:00', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:00', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:00', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:00', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:00', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:00', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:00', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:00', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:00', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:00', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:00', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:26', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:26', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:26', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:26', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:26', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:26', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:26', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:26', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:37', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:37', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:37', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:37', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:37', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:42:37', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:43:01', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:43:01', '354', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:43:01', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:43:01', '354', 'transaksi_detail', 1, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:43:01', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:43:01', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:43:01', '354', 'transaksi_detail', 0, '', '-40000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:43:01', '354', 'transaksi_detail', 0, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 354', '2020-01-20 09:44:51', '354', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 355', '2020-01-20 09:46:24', '355', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 355', '2020-01-20 09:46:40', '355', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 355', '2020-01-20 09:46:40', '355', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 355', '2020-01-20 09:46:40', '355', 'transaksi_detail', 0, '', '10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 355', '2020-01-20 09:46:45', '355', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 355', '2020-01-20 09:46:45', '355', 'transaksi_detail', 1, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 355', '2020-01-20 09:46:45', '355', 'transaksi_detail', 1, '', '10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 355', '2020-01-20 09:46:45', '355', 'transaksi_detail', 0, '', '-20000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 355', '2020-01-20 09:46:45', '355', 'transaksi_detail', 0, '', '10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 356', '2020-01-20 09:50:17', '356', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 356', '2020-01-20 09:50:32', '356', 'transaksi_detail', 1, '', '500000');
INSERT INTO `log` (`ket`, `datetime`, `no_transaksi`, `nama_tabel`, `user`, `data_lama`, `data_baru`) VALUES
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 356', '2020-01-20 09:50:32', '356', 'transaksi_detail', 0, '', '-50000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 356', '2020-01-20 09:50:37', '356', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 356', '2020-01-20 09:50:37', '356', 'transaksi_detail', 1, '', '-50000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 356', '2020-01-20 09:50:37', '356', 'transaksi_detail', 0, '', '-50000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 356', '2020-01-20 09:50:47', '356', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 356', '2020-01-20 09:50:47', '356', 'transaksi_detail', 1, '', '-50000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 356', '2020-01-20 09:50:47', '356', 'transaksi_detail', 0, '', '-50000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 356', '2020-01-21 01:38:16', '356', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 356', '2020-01-21 01:38:16', '356', 'transaksi_detail', 1, '', '-50000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 356', '2020-01-21 01:38:16', '356', 'transaksi_detail', 0, '', '-50000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 357', '2020-01-21 01:38:55', '357', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 357', '2020-01-21 01:38:55', '357', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 357', '2020-01-21 01:39:05', '357', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 357', '2020-01-21 01:39:05', '357', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 357', '2020-01-21 01:39:05', '357', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 357', '2020-01-21 01:43:44', '357', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 357', '2020-01-21 01:43:44', '357', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 357', '2020-01-21 01:43:44', '357', 'transaksi_detail', 0, '', '-10000'),
('Update data ke tabel supplier\r\n  , kode_suplier= SPL-001', '2020-01-21 02:23:11', 'SPL-001', 'supplier', 0, 'kode_suplier=SPL-001bank=bcarekening=123123123kota=medandddcabang=Medan', 'kode_suplier=SPL-001bank=bcarekening=123123123kota=medandddcabang=Medan'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 02:20:55', '358', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 02:20:55', '358', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 359', '2020-01-22 02:22:01', '359', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 359', '2020-01-22 02:22:01', '359', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 02:59:29', '358', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 02:59:29', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 02:59:29', '358', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 02:59:43', '358', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 02:59:43', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 02:59:43', '358', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:00:08', '358', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:00:08', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:00:08', '358', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:00:15', '358', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:00:15', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:00:15', '358', 'transaksi_detail', 0, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:09:08', '358', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:09:09', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:09:09', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:09:24', '358', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:09:24', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:09:24', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:10:18', '358', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:10:18', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:10:18', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:11:13', '358', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:11:13', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:11:13', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:12:33', '358', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:12:33', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 358', '2020-01-22 03:12:33', '358', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 359', '2020-01-22 03:14:38', '359', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 359', '2020-01-22 03:14:38', '359', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 359', '2020-01-22 03:14:38', '359', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 359', '2020-01-22 03:15:29', '359', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 359', '2020-01-22 03:15:29', '359', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 359', '2020-01-22 03:15:29', '359', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-24 02:50:22', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-24 04:05:33', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 360', '2020-01-24 06:59:15', '360', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 360', '2020-01-26 12:59:42', '360', 'transaksi_detail', 1, '', '1000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 361', '2020-01-26 13:04:51', '361', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 361', '2020-01-26 13:08:01', '361', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 362', '2020-01-26 13:14:03', '362', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 362', '2020-01-26 13:14:11', '362', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 362', '2020-01-26 13:14:16', '362', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 363', '2020-01-26 13:27:38', '363', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 363', '2020-01-26 13:27:38', '363', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-26 13:30:55', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 364', '2020-01-26 13:31:38', '364', 'transaksi_detail', 1, '', '3000000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-01-30 10:12:49', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 363', '2020-01-30 10:20:25', '363', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 363', '2020-01-30 10:20:25', '363', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 363', '2020-01-30 10:20:25', '363', 'transaksi_detail', 1, '', '-10000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-09 15:00:30', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-11 02:12:56', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-11 03:40:57', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-11 06:59:50', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-11 07:10:53', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-11 07:51:19', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-13 03:05:50', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-13 03:06:22', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-13 06:24:51', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-13 06:27:33', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-13 06:54:52', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-15 02:22:07', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-17 04:33:47', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-17 06:13:13', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-18 01:26:30', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-20 01:41:39', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 365', '2020-02-20 02:07:16', '365', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-20 02:11:31', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 366', '2020-02-20 02:50:13', '366', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-20 02:55:07', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 367', '2020-02-20 02:57:45', '367', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 367', '2020-02-20 02:59:50', '367', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 367', '2020-02-20 03:00:00', '367', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 367', '2020-02-20 03:04:34', '367', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 367', '2020-02-20 03:06:09', '367', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-20 03:31:06', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-20 03:37:35', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-02-20 03:44:08', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-03-02 05:18:33', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-03-02 05:59:40', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-03-02 06:19:51', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-03-02 11:48:27', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-03-02 11:59:51', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 368', '2020-03-02 12:06:57', '368', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-03-02 13:15:26', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 369', '2020-03-02 13:21:22', '369', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-03-31 03:54:00', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-03-31 04:02:51', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-11 02:25:04', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-11 06:53:30', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-11 07:14:02', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-12 09:22:35', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-14 07:34:51', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 370', '2020-04-14 07:36:15', '370', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 370', '2020-04-14 07:37:35', '370', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-14 07:54:28', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-15 02:07:53', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-15 03:07:39', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 371', '2020-04-15 03:39:53', '371', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 371', '2020-04-15 03:47:06', '371', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-15 03:58:47', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 371', '2020-04-15 04:22:49', '371', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-15 06:44:23', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 372', '2020-04-16 04:44:13', '372', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 372', '2020-04-16 04:44:43', '372', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-16 07:31:16', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 373', '2020-04-16 07:45:18', '373', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-16 07:47:27', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 374', '2020-04-16 07:49:53', '374', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 373', '2020-04-16 07:56:16', '373', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-16 12:54:35', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 375', '2020-04-16 14:37:23', '375', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 375', '2020-04-16 14:39:16', '375', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 376', '2020-04-16 14:48:10', '376', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-16 14:59:46', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-16 15:04:52', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-16 15:17:16', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 377', '2020-04-16 15:32:39', '377', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 377', '2020-04-16 15:34:24', '377', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-16 15:49:23', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-17 02:18:34', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-17 06:43:01', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-17 06:43:49', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 378', '2020-04-17 06:52:06', '378', 'transaksi_detail', 1, '', '600000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-17 06:53:20', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-19 01:34:41', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-19 01:41:17', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 379', '2020-04-19 01:42:33', '379', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 380', '2020-04-19 02:45:11', '380', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 380', '2020-04-19 07:34:40', '380', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 380', '2020-04-19 07:45:42', '380', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 381', '2020-04-19 07:49:34', '381', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 381', '2020-04-19 07:49:58', '381', 'transaksi_detail', 1, '', '2000000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 382', '2020-04-19 08:22:58', '382', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 382', '2020-04-19 13:11:14', '382', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 382', '2020-04-19 13:14:15', '382', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 382', '2020-04-19 13:20:14', '382', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 382', '2020-04-19 13:20:22', '382', 'transaksi_detail', 1, '', '200000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 383', '2020-04-19 13:27:27', '383', 'transaksi_detail', 1, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 383', '2020-04-19 13:27:27', '383', 'transaksi_detail', 1, '', '5000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-19 13:54:37', '', 'transaksi_department', 1, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-20 14:01:14', '', 'transaksi_department', 13, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-22 02:57:50', '', 'transaksi_department', 13, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-22 06:26:44', '', 'transaksi_department', 13, '', '0'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 384', '2020-04-22 06:47:36', '384', 'transaksi_detail', 13, '', '500000'),
('Insert data ke tabel transaksi_detail\r\n  , cashbankno = 385', '2020-04-22 07:53:49', '385', 'transaksi_detail', 13, '', '500000'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-23 01:23:04', '', 'transaksi_department', 13, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-04-23 02:18:52', '', 'transaksi_department', 13, '', '0'),
('Insert data ke tabel transaksi_department\r\n  , cashbankno = ', '2020-05-10 10:38:10', '', 'transaksi_department', 13, '', '0'),
('Update data ke tabel supplier\r\n  , kode_suplier= SPL-003', '2020-05-11 23:21:05', 'SPL-003', 'supplier', 0, 'kode_suplier=SPL-003bank=BCArekening=212321kota=jakartacabang=Balaraja', 'kode_suplier=SPL-003bank=BCArekening=212321kota=jakartacabang=Balaraja'),
('Update data ke tabel supplier\r\n  , kode_suplier= SPL-003', '2020-05-11 23:21:10', 'SPL-003', 'supplier', 0, 'kode_suplier=SPL-003bank=BCArekening=212321kota=jakartacabang=Balaraja', 'kode_suplier=SPL-003bank=BCArekening=212321kota=jakartacabang=Balaraja');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `idmobil` int(11) NOT NULL,
  `merek` varchar(30) NOT NULL,
  `idjenis` int(11) NOT NULL,
  `idtype` int(11) NOT NULL,
  `tglbeli` date NOT NULL,
  `tglpakai` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`idmobil`, `merek`, `idjenis`, `idtype`, `tglbeli`, `tglpakai`, `id_user`) VALUES
(2, 'Hino', 2, 22, '2020-05-13', '2020-05-14', 16);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `id_pembelian_detail` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` decimal(19,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id_pembelian_detail`, `id_pembelian`, `id_barang`, `qty`, `harga`) VALUES
(17, 10, 1, 10, '1500.25'),
(18, 10, 4, 10, '2000.00');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_header`
--

CREATE TABLE `pembelian_header` (
  `id_pembelian` int(11) NOT NULL,
  `tanggal_no_po` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_po` datetime NOT NULL,
  `no_po` varchar(25) NOT NULL,
  `id_permintaan` int(11) NOT NULL,
  `id_suplier` int(11) NOT NULL,
  `id_dept` int(11) NOT NULL,
  `ppnpersen` int(11) NOT NULL,
  `ppnrupiah` decimal(19,2) NOT NULL,
  `pphpersen` int(11) NOT NULL,
  `pphrupiah` decimal(19,2) NOT NULL,
  `jumlah` decimal(19,2) NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_header`
--

INSERT INTO `pembelian_header` (`id_pembelian`, `tanggal_no_po`, `tgl_po`, `no_po`, `id_permintaan`, `id_suplier`, `id_dept`, `ppnpersen`, `ppnrupiah`, `pphpersen`, `pphrupiah`, `jumlah`, `status`, `id_user`) VALUES
(10, '2020-06-24 16:36:55', '2020-06-24 00:00:00', 'PO-MEDAN/240620/0001', 54, 1, 4, 0, '0.00', 0, '0.00', '35002.50', 2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `seting` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penyesuain_barang`
--

CREATE TABLE `penyesuain_barang` (
  `id_penyesuaian` int(11) NOT NULL,
  `tgl_penyesuaian` date NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `keterangan` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `di_buat` varchar(20) NOT NULL,
  `tgl_approve` int(11) NOT NULL,
  `id_setujui` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_jasa_detail`
--

CREATE TABLE `permintaan_jasa_detail` (
  `id_jasa_detail` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `deskripsi` varchar(300) NOT NULL,
  `unit` int(11) NOT NULL,
  `harga` decimal(19,2) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `total` decimal(19,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_jasa_header`
--

CREATE TABLE `permintaan_jasa_header` (
  `id_permintaan_jasa` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_departement` int(11) NOT NULL,
  `no_permintaan_jasa` varchar(50) NOT NULL,
  `nama_request` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tgl_minta_jasa` datetime NOT NULL,
  `tgl_approve` int(11) NOT NULL,
  `cpr_no` int(11) NOT NULL,
  `verifikasi_code` varchar(20) NOT NULL,
  `coding` varchar(20) NOT NULL,
  `kepada` int(50) NOT NULL,
  `status` int(11) NOT NULL,
  `grandtotal` decimal(19,2) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_pembelian_detail`
--

CREATE TABLE `permintaan_pembelian_detail` (
  `id_permintaan_detail` int(11) NOT NULL,
  `id_permintaan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga` decimal(19,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(19,2) NOT NULL,
  `tanggal_po` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_pembelian_detail`
--

INSERT INTO `permintaan_pembelian_detail` (`id_permintaan_detail`, `id_permintaan`, `id_barang`, `harga`, `qty`, `total`, `tanggal_po`, `status`) VALUES
(43, 54, 1, '1500.25', 10, '15002.50', '0000-00-00 00:00:00', 1),
(44, 54, 4, '2000.00', 10, '20000.00', '0000-00-00 00:00:00', 1),
(45, 55, 1, '1500.25', 50, '75012.50', '0000-00-00 00:00:00', 1),
(46, 55, 4, '2000.00', 50, '100000.00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_pembelian_header`
--

CREATE TABLE `permintaan_pembelian_header` (
  `id_permintaan` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_departement` int(11) NOT NULL,
  `no_permintaan` varchar(20) NOT NULL,
  `nama_request` varchar(30) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `id_bagian` int(11) NOT NULL,
  `tanggal_minta` datetime NOT NULL,
  `tanggal_approve` datetime NOT NULL,
  `tanggal_po` datetime NOT NULL,
  `tanggal_brg_dtg` datetime NOT NULL,
  `cpr_no` varchar(50) NOT NULL,
  `verifikasi_kode` varchar(10) NOT NULL,
  `coding` varchar(11) NOT NULL,
  `kepada` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `grandtotal` decimal(19,2) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_pembelian_header`
--

INSERT INTO `permintaan_pembelian_header` (`id_permintaan`, `tanggal`, `id_departement`, `no_permintaan`, `nama_request`, `keterangan`, `id_bagian`, `tanggal_minta`, `tanggal_approve`, `tanggal_po`, `tanggal_brg_dtg`, `cpr_no`, `verifikasi_kode`, `coding`, `kepada`, `status`, `grandtotal`, `id_user`, `hub`) VALUES
(54, '2020-06-24 16:36:03', 4, 'MEDAN/240620/0001', 'ali', NULL, 5, '2020-06-24 00:00:00', '2020-06-24 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'a', 'a', '', 3, '35002.50', 13, 4),
(55, '2020-06-28 16:17:11', 4, 'MEDAN/280620/0001', 'a', NULL, 1, '2020-06-28 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'a', 'a', '', 1, '175012.50', 13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_pengerjaan`
--

CREATE TABLE `permintaan_pengerjaan` (
  `id_pernintaan_pengerjaan` int(11) NOT NULL,
  `no_pengerjaan` varchar(20) NOT NULL,
  `tgl_order` datetime NOT NULL,
  `id_departement` int(11) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `deskripsi_peminta` varchar(200) NOT NULL,
  `tanggal_cek` datetime NOT NULL,
  `pic_cek` char(20) NOT NULL,
  `deskripsi_perkerja` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posisikas`
--

CREATE TABLE `posisikas` (
  `id_posisi` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `tglposisi` date NOT NULL,
  `cashonhand` float(10,2) NOT NULL,
  `kasbonsementara` float(10,2) NOT NULL,
  `oskasbank` float(10,2) NOT NULL,
  `selisih` float(10,2) NOT NULL,
  `ttlpettycash` float(10,2) NOT NULL,
  `outstanding_r_ho` float(10,2) NOT NULL,
  `gtotal` float(10,2) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posisikas`
--

INSERT INTO `posisikas` (`id_posisi`, `id_department`, `tglposisi`, `cashonhand`, `kasbonsementara`, `oskasbank`, `selisih`, `ttlpettycash`, `outstanding_r_ho`, `gtotal`, `id_user`) VALUES
(25, 4, '2020-04-19', 8000000.00, 0.00, 500000.00, 0.00, 8500000.00, 0.00, 8500000.00, 1),
(26, 7, '2019-12-19', 33200000.00, 0.00, 0.00, 0.00, 33200000.00, 0.00, 0.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(10) NOT NULL,
  `keterangan` varchar(10) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`, `keterangan`, `id_user`) VALUES
(1, 'pcs', 'dd', 16),
(4, 'Lsn', '', 16);

-- --------------------------------------------------------

--
-- Table structure for table `stok_keluar`
--

CREATE TABLE `stok_keluar` (
  `id_stok_keluar` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga` float(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_keluar`
--

INSERT INTO `stok_keluar` (`id_stok_keluar`, `id_department`, `id_barang`, `harga`, `qty`, `tanggal`, `id_user`) VALUES
(2, 1, 1, 0.00, 9, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id_stok_masuk` int(11) NOT NULL,
  `id_suplier` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga` float(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_masuk`
--

INSERT INTO `stok_masuk` (`id_stok_masuk`, `id_suplier`, `id_barang`, `harga`, `qty`, `tanggal`, `id_user`) VALUES
(2, 2, 2, 0.00, 10, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `id_suplier` int(11) NOT NULL,
  `kode_suplier` varchar(20) NOT NULL,
  `suplier` varchar(30) NOT NULL,
  `bank` varchar(20) NOT NULL,
  `rekening` varchar(20) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `cabang` varchar(20) NOT NULL,
  `approve` int(1) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id_suplier`, `kode_suplier`, `suplier`, `bank`, `rekening`, `kota`, `cabang`, `approve`, `id_user`) VALUES
(1, 'SPL-001', 'PT Bla bla', 'bca', '123123123', 'medanddd', 'Medan', 1, 0),
(2, 'SPL-002', 'xx', 'BNI', '123123', 'Medan', 'Makasar', 1, 0),
(4, 'SPL-003', 'Tono', 'BCA', '212321', 'jakarta', 'Balaraja', 0, 0);

--
-- Triggers `suplier`
--
DELIMITER $$
CREATE TRIGGER `after_insert_suplier_bi` AFTER INSERT ON `suplier` FOR EACH ROW BEGIN
  INSERT INTO LOG (ket,no_transaksi,nama_tabel, user, data_baru)
  VALUES (CONCAT('Insert data ke tabel supplier\r\n  , kode_suplier= ', NEW.kode_suplier), NEW.kode_suplier , 'supplier', NEW.id_user,CONCAT('kode_suplier=', NEW.kode_suplier,'bank=',NEW.bank,'rekening=',NEW.rekening,'kota=',NEW.kota,'cabang=',NEW.cabang));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_suplier` AFTER UPDATE ON `suplier` FOR EACH ROW BEGIN
  INSERT INTO LOG (ket,no_transaksi,nama_tabel, user, data_lama, data_baru)
  VALUES (CONCAT('Update data ke tabel supplier\r\n  , kode_suplier= ', NEW.kode_suplier),
 NEW.kode_suplier ,
 'supplier', 
NEW.id_user,
CONCAT('kode_suplier=', OLD.kode_suplier,'bank=',OLD.bank,'rekening=',OLD.rekening,'kota=',OLD.kota,'cabang=',OLD.cabang),
CONCAT('kode_suplier=', NEW.kode_suplier,'bank=',NEW.bank,'rekening=',NEW.rekening,'kota=',NEW.kota,'cabang=',NEW.cabang));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `terima_barang_detail`
--

CREATE TABLE `terima_barang_detail` (
  `id_terimabarangdetail` int(11) NOT NULL,
  `id_terimabarang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty_order` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `qty_terima` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terima_barang_detail`
--

INSERT INTO `terima_barang_detail` (`id_terimabarangdetail`, `id_terimabarang`, `id_barang`, `qty_order`, `id_satuan`, `qty_terima`, `keterangan`) VALUES
(71, 9, 1, 400, 1, 399, 'kurang 1'),
(72, 9, 4, 500, 4, 500, 'barang bagus'),
(73, 10, 1, 10, 1, 9, 'kurang 1'),
(74, 10, 4, 10, 4, 9, 'kurang 1');

-- --------------------------------------------------------

--
-- Table structure for table `terima_barang_header`
--

CREATE TABLE `terima_barang_header` (
  `id_terimabarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `no_trans_trm_brg` varchar(30) NOT NULL,
  `id_po` int(11) NOT NULL,
  `tgl_terima_barang` datetime NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terima_barang_header`
--

INSERT INTO `terima_barang_header` (`id_terimabarang`, `tanggal`, `no_trans_trm_brg`, `id_po`, `tgl_terima_barang`, `keterangan`, `status`) VALUES
(9, '2020-06-24 16:33:15', 'TRM-MEDAN/240620/0001', 9, '2020-06-24 00:00:00', 'asdasd', 1),
(10, '2020-06-24 16:38:00', 'TRM-MEDAN/240620/0002', 10, '2020-06-24 00:00:00', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipemobil`
--

CREATE TABLE `tipemobil` (
  `idtipemobil` int(11) NOT NULL,
  `tipemobil` varchar(30) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipemobil`
--

INSERT INTO `tipemobil` (`idtipemobil`, `tipemobil`, `id_user`, `hub`) VALUES
(22, 's', 16, 0),
(24, 'b', 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `cashbankno` varchar(20) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `id_transaksi_dept` varchar(500) NOT NULL,
  `pemohon` varchar(30) NOT NULL,
  `keperluan` varchar(100) NOT NULL,
  `catatan` varchar(100) NOT NULL,
  `no_batch` varchar(10) NOT NULL,
  `tgl_proses` date NOT NULL,
  `tgl_penerima` date NOT NULL,
  `no_bpk` varchar(10) NOT NULL,
  `no_giro` varchar(10) NOT NULL,
  `total` float NOT NULL,
  `idsuplier` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `cashbankno`, `tgl_pengajuan`, `id_transaksi_dept`, `pemohon`, `keperluan`, `catatan`, `no_batch`, `tgl_proses`, `tgl_penerima`, `no_bpk`, `no_giro`, `total`, `idsuplier`, `status`, `id_user`, `hub`) VALUES
(385, 'KK-00000001', '2020-04-22', 'a:1:{i:0;s:3:\"210\";}', 'Friski', 'BS-00000001: sadasdasd', 'BS-00000001: sadasdasd', '', '2020-04-22', '0000-00-00', '', '', 500000, 0, 2, 13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_bbm`
--

CREATE TABLE `transaksi_bbm` (
  `id_transaksi_bbm` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_kendaraan` int(11) NOT NULL,
  `id_driver` int(11) NOT NULL,
  `id_helper` int(11) NOT NULL,
  `km_awal` int(11) NOT NULL,
  `km_akhir` int(11) NOT NULL,
  `jml_liter` decimal(19,2) NOT NULL,
  `jarak` int(11) NOT NULL,
  `bbmharga` decimal(19,2) NOT NULL,
  `ttlbbm` decimal(19,2) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_bbm`
--

INSERT INTO `transaksi_bbm` (`id_transaksi_bbm`, `tanggal`, `id_kendaraan`, `id_driver`, `id_helper`, `km_awal`, `km_akhir`, `jml_liter`, `jarak`, `bbmharga`, `ttlbbm`, `id_user`, `hub`) VALUES
(11, '2020-05-29', 5, 11, 12, 2000, 3600, '27.15', 1600, '5000.00', '135750.00', 16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_department`
--

CREATE TABLE `transaksi_department` (
  `id_transaksi_dept` int(11) NOT NULL,
  `no_bs` varchar(20) NOT NULL,
  `no_kas_bank` varchar(128) NOT NULL,
  `tanggal` date NOT NULL,
  `pemohon` varchar(20) NOT NULL,
  `jenis_transaksi` varchar(100) NOT NULL,
  `id_dept` int(11) NOT NULL,
  `idbagian` int(11) NOT NULL,
  `jmlajuan` float(10,2) NOT NULL,
  `jumlah` float(10,2) NOT NULL,
  `tgl_setuju` datetime NOT NULL,
  `disetujui` char(20) NOT NULL,
  `penerima` char(20) NOT NULL,
  `tgl_terima` datetime NOT NULL,
  `tgl_realisasi` datetime NOT NULL,
  `jumlah_awal` float(10,2) NOT NULL,
  `terpakai` float(19,2) NOT NULL,
  `selisih` float(10,2) NOT NULL,
  `nkasbank` float(10,2) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_edit` datetime NOT NULL,
  `tgl_hapus` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_department`
--

INSERT INTO `transaksi_department` (`id_transaksi_dept`, `no_bs`, `no_kas_bank`, `tanggal`, `pemohon`, `jenis_transaksi`, `id_dept`, `idbagian`, `jmlajuan`, `jumlah`, `tgl_setuju`, `disetujui`, `penerima`, `tgl_terima`, `tgl_realisasi`, `jumlah_awal`, `terpakai`, `selisih`, `nkasbank`, `keterangan`, `tgl_buat`, `tgl_edit`, `tgl_hapus`, `status`, `id_user`, `hub`) VALUES
(210, 'BS-00000001', 'KK-00000001', '2020-04-22', 'Friski', '', 4, 1, 1000000.00, 1000000.00, '2020-04-22 00:00:00', 'Sumiati', 'Friski', '2020-04-22 00:00:00', '2020-04-22 00:00:00', 1000000.00, 500000.00, 500000.00, 500000.00, 'sadasdasd', '2020-04-22 13:26:44', '2020-04-22 00:00:00', '0000-00-00 00:00:00', 4, 13, 4),
(211, 'BS-00000002', '', '2020-04-23', 'Friski', '', 4, 1, 1000000.00, 1000000.00, '2020-04-23 00:00:00', 'Sumiati', 'Friski', '2020-04-23 00:00:00', '2020-04-23 00:00:00', 1000000.00, 500000.00, 500000.00, 0.00, 'sadasdasd', '2020-04-23 08:23:04', '2020-04-23 00:00:00', '0000-00-00 00:00:00', 3, 13, 4),
(212, 'BS-00000003', '', '2020-04-23', 'Friski', '', 4, 2, 1000000.00, 1000000.00, '2020-05-19 00:00:00', 'Sumiati', 'Friski', '2020-05-19 00:00:00', '2020-05-20 00:00:00', 1000000.00, 0.00, 875439.00, 0.00, 'sadasdasd', '2020-04-23 09:18:52', '2020-05-20 00:00:00', '0000-00-00 00:00:00', 2, 13, 4),
(213, 'BS-00000004', '', '2020-05-10', 'Friski', '', 4, 1, 1000000.00, 0.00, '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, 0.00, 0.00, 'sadasdasd', '2020-05-10 17:38:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 13, 4);

--
-- Triggers `transaksi_department`
--
DELIMITER $$
CREATE TRIGGER `after_insert_trx_dpt` AFTER INSERT ON `transaksi_department` FOR EACH ROW BEGIN
  INSERT INTO LOG (ket,no_transaksi,nama_tabel, user, data_baru)
  VALUES (CONCAT('Insert data ke tabel transaksi_department\r\n  , cashbankno = '
  , NEW.no_kas_bank)
  , NEW.no_kas_bank
  , 'transaksi_department'
  , NEW.id_user
  , NEW.jumlah_awal);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `loc_iddept` int(11) NOT NULL,
  `loc` varchar(10) NOT NULL,
  `id_coa_ec` int(11) NOT NULL,
  `id_coa_na` int(11) NOT NULL,
  `id_coa_tb` int(11) NOT NULL,
  `nominal` float(10,2) NOT NULL,
  `ppn` int(11) NOT NULL,
  `pph` int(11) NOT NULL,
  `coa_ec_account` varchar(10) NOT NULL,
  `coa_na_account` varchar(10) NOT NULL,
  `coa_tb_account` varchar(10) NOT NULL,
  `coa_ec_nama` varchar(50) NOT NULL,
  `coa_na_nama` varchar(50) NOT NULL,
  `coa_tb_nama` varchar(50) NOT NULL,
  `tanggal_kas_bon` datetime NOT NULL,
  `tgl_penerima` datetime NOT NULL,
  `tgl_penajuan` datetime NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `jenis`, `loc_iddept`, `loc`, `id_coa_ec`, `id_coa_na`, `id_coa_tb`, `nominal`, `ppn`, `pph`, `coa_ec_account`, `coa_na_account`, `coa_tb_account`, `coa_ec_nama`, `coa_na_nama`, `coa_tb_nama`, `tanggal_kas_bon`, `tgl_penerima`, `tgl_penajuan`, `keterangan`, `status`, `id_user`, `hub`) VALUES
(1075, 385, 'KK', 4, '094', 1, 1, 2, 500000.00, 0, 0, '0', '111', '555', 'NERACA', 'Gaji Pokok', 'ggg', '2020-04-22 00:00:00', '2020-04-22 00:00:00', '0000-00-00 00:00:00', '', 2, 13, 4);

--
-- Triggers `transaksi_detail`
--
DELIMITER $$
CREATE TRIGGER `after_insert_transaksi_detail_ai` AFTER INSERT ON `transaksi_detail` FOR EACH ROW BEGIN
  INSERT INTO LOG (ket,no_transaksi,nama_tabel, user, data_baru)
  VALUES (CONCAT('Insert data ke tabel transaksi_detail\r\n  , cashbankno = '
  , NEW.id_transaksi)
  , NEW.id_transaksi
  , 'transaksi_detail'
  , NEW.id_user
  , NEW.nominal);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `truck`
--

CREATE TABLE `truck` (
  `id_truck` int(11) NOT NULL,
  `no_urut` int(11) NOT NULL,
  `no_polisi` varchar(20) NOT NULL,
  `idmobil` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `helper_id` int(11) NOT NULL,
  `bbm_perliter` decimal(12,2) NOT NULL,
  `bbm_akumulasi` decimal(12,3) NOT NULL,
  `toleran` decimal(12,3) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `truck`
--

INSERT INTO `truck` (`id_truck`, `no_urut`, `no_polisi`, `idmobil`, `driver_id`, `helper_id`, `bbm_perliter`, `bbm_akumulasi`, `toleran`, `id_user`, `hub`) VALUES
(5, 2, 'BK 021 EE', 2, 11, 12, '9.99', '12.034', '12.000', 13, 4),
(8, 2, 'BK 021 EE', 2, 0, 0, '9.99', '12.034', '12.000', 16, 4),
(9, 2, 'BK 021 EE', 2, 0, 0, '9.99', '12.034', '12.000', 16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`, `hub`) VALUES
(16, 'Ricky Yacob', 'yacob.ricky84@gmail.com', 'default.jpg', '$2y$10$wR1yS0ysC5S0A.RVYmYrDeSXSmVuVlnq6D9hfwcmvxia7PxGk8p2a', 1, 1, 1587391306, 4),
(18, 'Ocil', 'ocil@gmail.com', 'default.jpg', '$2y$10$87eDn0JbTU8EjyoI9u3CdeRZ16O6C5PXiulMyWhDF/fc42OPRY4Eq', 2, 1, 1593408244, 4),
(19, 'fernando', 'fernando@gmail.com', 'default.jpg', '$2y$10$w4PuZabtFwG0meta2JQXKOPak1vwIgnv14Rd89dD3XT8IxQiicAwS', 4, 1, 1593575536, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(24, 1, 1),
(32, 1, 3),
(34, 1, 7),
(35, 2, 4),
(36, 2, 7),
(37, 1, 8),
(41, 2, 8),
(42, 3, 9),
(43, 3, 2),
(47, 1, 10),
(49, 1, 9),
(52, 3, 11),
(53, 4, 10),
(59, 2, 2),
(60, 1, 2),
(62, 1, 13),
(65, 1, 4),
(66, 1, 15),
(68, 1, 17),
(70, 1, 16),
(71, 1, 11),
(73, 1, 19),
(74, 5, 19),
(75, 5, 16),
(76, 3, 15);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `idurut` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `idurut`, `menu`) VALUES
(1, 1, 'Admin'),
(2, 2, 'User'),
(3, 3, 'Menu'),
(4, 4, 'Master'),
(7, 5, 'Transaksi'),
(8, 8, 'Laporan Finance'),
(9, 10, 'Purchasing'),
(10, 11, 'Approval '),
(11, 12, 'Transaksi Purchasing'),
(15, 9, 'Master Purchasing'),
(16, 14, 'Ekspedisi'),
(19, 13, 'Master Ekspedisi');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Finance'),
(3, 'Purchasing'),
(4, 'Head'),
(5, 'Ekspedisi');

-- --------------------------------------------------------

--
-- Table structure for table `user_submenu1`
--

CREATE TABLE `user_submenu1` (
  `id` int(11) NOT NULL,
  `idsubmenu` int(11) NOT NULL,
  `namasubmenu` varchar(128) NOT NULL,
  `url1` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_submenu1`
--

INSERT INTO `user_submenu1` (`id`, `idsubmenu`, `namasubmenu`, `url1`) VALUES
(12, 33, 'Kasbon', 'transaksi'),
(14, 33, 'Kas Kecil', 'transaksi/kaskecil'),
(15, 34, 'Rupiah', 'transaksi/kasrupiah'),
(16, 34, 'Non Rupiah', ''),
(18, 0, 'Realisasi', 'transaksi/realization'),
(19, 0, 'Status Realisasi', 'transaksi/realizationstatus'),
(20, 33, 'Kantor Pusat', 'transaksi/kantorpusat\r\n'),
(21, 39, 'O.S BS', 'laporan/lapoutstandingbs'),
(23, 39, 'O.S Belum Approve', 'laporan/belumapprove'),
(24, 39, 'Realisasi BS', 'laporan/realisasibs'),
(26, 40, 'Kas-bank', 'laporan/kasbank'),
(27, 40, 'Reimburst kas-bank', 'laporan/reimburstkasbank'),
(28, 40, 'Realisasi Pemb. Kas-bank', 'laporan/realisasipembkasbank'),
(29, 40, 'O.S KB Blum Proses HO', 'laporan/belumprosesho'),
(30, 40, 'O.S KB Belum Realisasi HO', 'laporan/oskbbelumrealisasiho');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `idx` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `st` int(1) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`idx`, `menu_id`, `title`, `url`, `icon`, `st`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 0, 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 0, 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 0, 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder-open', 0, 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-plus', 0, 1),
(6, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 0, 1),
(7, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 0, 1),
(8, 4, 'Crud A', 'master', 'fas fa-fw fa-cog', 0, 1),
(9, 4, 'Crud B', 'master/crudb', 'fas fa-fw fa-cog', 0, 1),
(10, 4, 'Crud C', 'master/crudc', 'fas fa-fw fa-cog', 0, 1),
(12, 4, 'Department', 'master/department', 'fas fa-fw fa-building', 0, 1),
(14, 6, 'Petty-cash List', 'finance', 'fas fa-fw fa-list', 0, 0),
(15, 6, 'Realization', 'finance/realization', 'fas fa-fw fa-money-check-alt', 0, 0),
(16, 6, 'Realization Status', 'finance/realizationstatus', 'fas fa-fw fa-file-alt', 0, 0),
(17, 6, 'Posisi Kas', 'finance/posisikas', 'fas fa-fw fa-wallet', 0, 0),
(18, 6, 'Manage Transaction', 'finance/managetransaction', 'fas fa-fw fa-cog', 0, 0),
(19, 4, 'Supplier', 'master/supplier', 'far fa-fw fa-address-book', 0, 1),
(23, 5, 'Pettycash', 'pettycash', 'far fa-fw fa-credit-card', 0, 0),
(33, 7, 'Bon Sementara', '', 'fas fa-fw fa-book', 1, 1),
(34, 7, 'Kas Bank', '', 'far fa-fw fa-credit-card', 1, 1),
(35, 7, 'Kas Harian', 'transaksi/kasharian', 'fas fa-money-bill-alt', 0, 1),
(36, 7, 'Ikhtisar', 'transaksi/ikhtisar\r\n\r\n\r\n', 'fas fa-money-check-alt', 0, 1),
(37, 8, 'Aging Kas bank', 'laporan', 'fas fa-fw fa-cog', 0, 0),
(38, 8, 'laporan kas Bank', 'laporan/lapkasbank', 'fas fa-fw fa-cog', 0, 0),
(39, 8, 'Bon Sementara', '', 'fas fa-comments-dollar', 1, 1),
(40, 8, 'Kas bank', '', 'fas fa-comments-dollar', 1, 1),
(42, 9, 'Permintaan Pembelian', 'purchasing/index', 'fas fa-fw fa-cog', 0, 1),
(78, 4, 'Lokasi', 'master/lokasi', 'fas fa-fw fa-thumbtack', 0, 1),
(82, 10, 'PR Barang', 'approval/index', 'fas fa-fw fa-cog', 0, 1),
(83, 11, 'Pembelian Order', 'purchasing/pembelianorder', 'fas fa-fw fa-cog', 0, 1),
(84, 11, 'Penerimaan Barang', 'purchasing/penerimaanbarang', 'fas fa-fw fa-cog', 0, 1),
(85, 9, 'Permintaan Jasa', 'purchasing/permintaanjasa', 'fas fa-fw fa-cog', 0, 1),
(87, 15, 'Satuan Barang', 'purchasing/satuanbarang', 'fas fa-fw fa-cog', 0, 1),
(88, 15, 'Categori Barang', 'purchasing/categoribarang', 'fas fa-fw fa-cog', 0, 1),
(89, 15, 'Barang', 'purchasing/barang', 'fas fa-fw fa-cog', 0, 1),
(90, 19, 'Jenis Mobil', 'ekspedisi/jenismobil', 'fas fa-fw fa-cog', 0, 1),
(91, 19, 'Tipe Mobil', 'ekspedisi/tipemobil', 'fas fa-truck-pickup', 0, 1),
(92, 19, 'Mobil', 'ekspedisi/mobil', 'fas fa-fw fa-car-alt\r\n', 0, 1),
(93, 19, 'Driver', 'ekspedisi/driver', 'fas fa-people-carry', 0, 1),
(94, 19, 'Truck', 'ekspedisi/truck', 'fas fa-truck-moving', 0, 1),
(95, 16, 'Bbm', 'ekspedisi/bbm', 'fas fa-fw fa-gas-pump', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(0, 'frisky.sianipar@matahari.com', 'jlSd3qtm5AyX8kRDtBKiv5mVKe0t/cMLyZ+Ize4EKWg=', 1587346895),
(0, 'friskisianipar@matahari.com', 'dA4zVh0DwuZWo89AlLNua6hhlPDF3Q1lucCx6Xh9wKA=', 1587347021),
(0, 'frisky.sianipar@matahari.com', 'baqnyfnW2PH4RHK1J8b2qIoDnO8rW09ckkoQZeFkFpg=', 1587372999),
(0, 'frisky.sianipar@matahari.com', 'EzKBo1rukG6Yt5s2PNYMduOdpG5T6Vf8XQkqfqCRGT8=', 1587373233),
(0, 'ocil@gmail.com', 'iI1Xq0GBe2uTyE3VRYYTtfvfNc51EHH+KYsSIrx4Ato=', 1593406749),
(0, 'ocil@gmail.com', 'XUZd3k6o3J/o2iTEgnrb1VKdKd2S+p9OelVYZfiSSgE=', 1593408244),
(0, 'fernando@gmail.com', '7L9SSaepQrc6iqp3N/zB0AssuZUuxYkYy70cc9G35/M=', 1593575536);

-- --------------------------------------------------------

--
-- Table structure for table `validasi`
--

CREATE TABLE `validasi` (
  `id_validasi` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `jumlah` float(10,2) NOT NULL,
  `pecahan` float(10,2) NOT NULL,
  `masuk_sementara` float(10,2) NOT NULL,
  `belum_selesai` float(10,2) NOT NULL,
  `oustanding_r_ho` float(10,2) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `validasi`
--

INSERT INTO `validasi` (`id_validasi`, `department_id`, `jumlah`, `pecahan`, `masuk_sementara`, `belum_selesai`, `oustanding_r_ho`, `id_user`) VALUES
(98, 4, 45.00, 100000.00, 0.00, 0.00, 0.00, 0),
(99, 4, 50.00, 50000.00, 0.00, 0.00, 0.00, 0),
(100, 4, 50.00, 20000.00, 0.00, 0.00, 0.00, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`idbagian`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `bisnis`
--
ALTER TABLE `bisnis`
  ADD PRIMARY KEY (`idbisnis`);

--
-- Indexes for table `bskantorpusat`
--
ALTER TABLE `bskantorpusat`
  ADD PRIMARY KEY (`idbskantorpusat`);

--
-- Indexes for table `categori`
--
ALTER TABLE `categori`
  ADD PRIMARY KEY (`id_categori`);

--
-- Indexes for table `coa_ec`
--
ALTER TABLE `coa_ec`
  ADD PRIMARY KEY (`id_coa_ec`);

--
-- Indexes for table `coa_na`
--
ALTER TABLE `coa_na`
  ADD PRIMARY KEY (`id_coa_na`);

--
-- Indexes for table `coa_tb`
--
ALTER TABLE `coa_tb`
  ADD PRIMARY KEY (`id_coa_tb`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id_counter`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_departement`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id_driver`);

--
-- Indexes for table `ikhtisar_detail`
--
ALTER TABLE `ikhtisar_detail`
  ADD PRIMARY KEY (`id_ikhtisar_detail`);

--
-- Indexes for table `ikhtisar_header`
--
ALTER TABLE `ikhtisar_header`
  ADD PRIMARY KEY (`id_ikhtisar`);

--
-- Indexes for table `jenismobil`
--
ALTER TABLE `jenismobil`
  ADD PRIMARY KEY (`idjenismobil`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`idmobil`);

--
-- Indexes for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`id_pembelian_detail`);

--
-- Indexes for table `pembelian_header`
--
ALTER TABLE `pembelian_header`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `penyesuain_barang`
--
ALTER TABLE `penyesuain_barang`
  ADD PRIMARY KEY (`id_penyesuaian`);

--
-- Indexes for table `permintaan_jasa_header`
--
ALTER TABLE `permintaan_jasa_header`
  ADD PRIMARY KEY (`id_permintaan_jasa`);

--
-- Indexes for table `permintaan_pembelian_detail`
--
ALTER TABLE `permintaan_pembelian_detail`
  ADD PRIMARY KEY (`id_permintaan_detail`);

--
-- Indexes for table `permintaan_pembelian_header`
--
ALTER TABLE `permintaan_pembelian_header`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indexes for table `permintaan_pengerjaan`
--
ALTER TABLE `permintaan_pengerjaan`
  ADD PRIMARY KEY (`id_pernintaan_pengerjaan`);

--
-- Indexes for table `posisikas`
--
ALTER TABLE `posisikas`
  ADD PRIMARY KEY (`id_posisi`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`id_stok_keluar`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id_stok_masuk`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- Indexes for table `terima_barang_detail`
--
ALTER TABLE `terima_barang_detail`
  ADD PRIMARY KEY (`id_terimabarangdetail`);

--
-- Indexes for table `terima_barang_header`
--
ALTER TABLE `terima_barang_header`
  ADD PRIMARY KEY (`id_terimabarang`);

--
-- Indexes for table `tipemobil`
--
ALTER TABLE `tipemobil`
  ADD PRIMARY KEY (`idtipemobil`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_bbm`
--
ALTER TABLE `transaksi_bbm`
  ADD PRIMARY KEY (`id_transaksi_bbm`);

--
-- Indexes for table `transaksi_department`
--
ALTER TABLE `transaksi_department`
  ADD PRIMARY KEY (`id_transaksi_dept`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`);

--
-- Indexes for table `truck`
--
ALTER TABLE `truck`
  ADD PRIMARY KEY (`id_truck`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_submenu1`
--
ALTER TABLE `user_submenu1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`idx`);

--
-- Indexes for table `validasi`
--
ALTER TABLE `validasi`
  ADD PRIMARY KEY (`id_validasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bagian`
--
ALTER TABLE `bagian`
  MODIFY `idbagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bisnis`
--
ALTER TABLE `bisnis`
  MODIFY `idbisnis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bskantorpusat`
--
ALTER TABLE `bskantorpusat`
  MODIFY `idbskantorpusat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `categori`
--
ALTER TABLE `categori`
  MODIFY `id_categori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coa_ec`
--
ALTER TABLE `coa_ec`
  MODIFY `id_coa_ec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `coa_na`
--
ALTER TABLE `coa_na`
  MODIFY `id_coa_na` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=945;

--
-- AUTO_INCREMENT for table `coa_tb`
--
ALTER TABLE `coa_tb`
  MODIFY `id_coa_tb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `id_counter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `id_departement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id_driver` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ikhtisar_detail`
--
ALTER TABLE `ikhtisar_detail`
  MODIFY `id_ikhtisar_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `ikhtisar_header`
--
ALTER TABLE `ikhtisar_header`
  MODIFY `id_ikhtisar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `jenismobil`
--
ALTER TABLE `jenismobil`
  MODIFY `idjenismobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `idmobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `id_pembelian_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pembelian_header`
--
ALTER TABLE `pembelian_header`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penyesuain_barang`
--
ALTER TABLE `penyesuain_barang`
  MODIFY `id_penyesuaian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permintaan_jasa_header`
--
ALTER TABLE `permintaan_jasa_header`
  MODIFY `id_permintaan_jasa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permintaan_pembelian_detail`
--
ALTER TABLE `permintaan_pembelian_detail`
  MODIFY `id_permintaan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `permintaan_pembelian_header`
--
ALTER TABLE `permintaan_pembelian_header`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `permintaan_pengerjaan`
--
ALTER TABLE `permintaan_pengerjaan`
  MODIFY `id_pernintaan_pengerjaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posisikas`
--
ALTER TABLE `posisikas`
  MODIFY `id_posisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `id_stok_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id_stok_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `id_suplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `terima_barang_detail`
--
ALTER TABLE `terima_barang_detail`
  MODIFY `id_terimabarangdetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `terima_barang_header`
--
ALTER TABLE `terima_barang_header`
  MODIFY `id_terimabarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tipemobil`
--
ALTER TABLE `tipemobil`
  MODIFY `idtipemobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `transaksi_bbm`
--
ALTER TABLE `transaksi_bbm`
  MODIFY `id_transaksi_bbm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaksi_department`
--
ALTER TABLE `transaksi_department`
  MODIFY `id_transaksi_dept` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1076;

--
-- AUTO_INCREMENT for table `truck`
--
ALTER TABLE `truck`
  MODIFY `id_truck` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_submenu1`
--
ALTER TABLE `user_submenu1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `validasi`
--
ALTER TABLE `validasi`
  MODIFY `id_validasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
