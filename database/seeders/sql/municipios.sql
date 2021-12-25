-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 23, 2021 at 11:47 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `colombia`
--

--
-- Dumping data for table `municipios`
--

INSERT INTO `municipios` (`id`, `dane_code`, `name`, `departamento_id`) VALUES
(1, 5001, 'Medellín', 1),
(2, 5002, 'Abejorral', 1),
(3, 5004, 'Abriaquí', 1),
(4, 5021, 'Alejandría', 1),
(5, 5030, 'Amagá', 1),
(6, 5031, 'Amalfi', 1),
(7, 5034, 'Andes', 1),
(8, 5036, 'Angelópolis', 1),
(9, 5038, 'Angostura', 1),
(10, 5040, 'Anorí', 1),
(11, 15832, 'Tununguá', 2),
(12, 5044, 'Anza', 1),
(13, 5045, 'Apartadó', 1),
(14, 5051, 'Arboletes', 1),
(15, 5055, 'Argelia', 1),
(16, 5059, 'Armenia', 1),
(17, 5079, 'Barbosa', 1),
(18, 5088, 'Bello', 1),
(19, 5091, 'Betania', 1),
(20, 5093, 'Betulia', 1),
(21, 5101, 'Ciudad Bolívar', 1),
(22, 5107, 'Briceño', 1),
(23, 5113, 'Buriticá', 1),
(24, 5120, 'Cáceres', 1),
(25, 5125, 'Caicedo', 1),
(26, 5129, 'Caldas', 1),
(27, 5134, 'Campamento', 1),
(28, 5138, 'Cañasgordas', 1),
(29, 5142, 'Caracolí', 1),
(30, 5145, 'Caramanta', 1),
(31, 5147, 'Carepa', 1),
(32, 15476, 'Motavita', 2),
(33, 5150, 'Carolina', 1),
(34, 5154, 'Caucasia', 1),
(35, 5172, 'Chigorodó', 1),
(36, 5190, 'Cisneros', 1),
(37, 5197, 'Cocorná', 1),
(38, 5206, 'Concepción', 1),
(39, 5209, 'Concordia', 1),
(40, 5212, 'Copacabana', 1),
(41, 5234, 'Dabeiba', 1),
(42, 5237, 'Don Matías', 1),
(43, 5240, 'Ebéjico', 1),
(44, 5250, 'El Bagre', 1),
(45, 5264, 'Entrerrios', 1),
(46, 5266, 'Envigado', 1),
(47, 5282, 'Fredonia', 1),
(48, 23675, 'San Bernardo Del Viento', 3),
(49, 5306, 'Giraldo', 1),
(50, 5308, 'Girardota', 1),
(51, 5310, 'Gómez Plata', 1),
(52, 27361, 'Istmina', 4),
(53, 5315, 'Guadalupe', 1),
(54, 5318, 'Guarne', 1),
(55, 5321, 'Guatapé', 1),
(56, 5347, 'Heliconia', 1),
(57, 5353, 'Hispania', 1),
(58, 5360, 'Itagui', 1),
(59, 5361, 'Ituango', 1),
(60, 5086, 'Belmira', 1),
(61, 5368, 'Jericó', 1),
(62, 5376, 'La Ceja', 1),
(63, 5380, 'La Estrella', 1),
(64, 5390, 'La Pintada', 1),
(65, 5400, 'La Unión', 1),
(66, 5411, 'Liborina', 1),
(67, 5425, 'Maceo', 1),
(68, 5440, 'Marinilla', 1),
(69, 5467, 'Montebello', 1),
(70, 5475, 'Murindó', 1),
(71, 5480, 'Mutatá', 1),
(72, 5483, 'Nariño', 1),
(73, 5490, 'Necoclí', 1),
(74, 5495, 'Nechí', 1),
(75, 5501, 'Olaya', 1),
(76, 5541, 'Peñol', 1),
(77, 5543, 'Peque', 1),
(78, 5576, 'Pueblorrico', 1),
(79, 5579, 'Puerto Berrío', 1),
(80, 5585, 'Puerto Nare', 1),
(81, 5591, 'Puerto Triunfo', 1),
(82, 5604, 'Remedios', 1),
(83, 5607, 'Retiro', 1),
(84, 5615, 'Rionegro', 1),
(85, 5628, 'Sabanalarga', 1),
(86, 5631, 'Sabaneta', 1),
(87, 5642, 'Salgar', 1),
(88, 15189, 'Ciénega', 2),
(89, 52699, 'Santacruz', 5),
(90, 5652, 'San Francisco', 1),
(91, 5656, 'San Jerónimo', 1),
(92, 68575, 'Puerto Wilches', 6),
(93, 68573, 'Puerto Parra', 6),
(94, 5660, 'San Luis', 1),
(95, 5664, 'San Pedro', 1),
(96, 5667, 'San Rafael', 1),
(97, 5670, 'San Roque', 1),
(98, 5674, 'San Vicente', 1),
(99, 5679, 'Santa Bárbara', 1),
(100, 5690, 'Santo Domingo', 1),
(101, 5697, 'El Santuario', 1),
(102, 5736, 'Segovia', 1),
(103, 5761, 'Sopetrán', 1),
(104, 50370, 'Uribe', 7),
(105, 5789, 'Támesis', 1),
(106, 5790, 'Tarazá', 1),
(107, 5792, 'Tarso', 1),
(108, 5809, 'Titiribí', 1),
(109, 5819, 'Toledo', 1),
(110, 5837, 'Turbo', 1),
(111, 5842, 'Uramita', 1),
(112, 5847, 'Urrao', 1),
(113, 5854, 'Valdivia', 1),
(114, 5856, 'Valparaíso', 1),
(115, 5858, 'Vegachí', 1),
(116, 5861, 'Venecia', 1),
(117, 5885, 'Yalí', 1),
(118, 5887, 'Yarumal', 1),
(119, 5890, 'Yolombó', 1),
(120, 5893, 'Yondó', 1),
(121, 5895, 'Zaragoza', 1),
(122, 8001, 'Barranquilla', 8),
(123, 8078, 'Baranoa', 8),
(124, 8141, 'Candelaria', 8),
(125, 8296, 'Galapa', 8),
(126, 8421, 'Luruaco', 8),
(127, 8433, 'Malambo', 8),
(128, 8436, 'Manatí', 8),
(129, 8549, 'Piojó', 8),
(130, 8558, 'Polonuevo', 8),
(131, 8634, 'Sabanagrande', 8),
(132, 8638, 'Sabanalarga', 8),
(133, 8675, 'Santa Lucía', 8),
(134, 8685, 'Santo Tomás', 8),
(135, 8758, 'Soledad', 8),
(136, 8770, 'Suan', 8),
(137, 8832, 'Tubará', 8),
(138, 8849, 'Usiacurí', 8),
(139, 13006, 'Achí', 9),
(140, 13042, 'Arenal', 9),
(141, 13052, 'Arjona', 9),
(142, 13062, 'Arroyohondo', 9),
(143, 13140, 'Calamar', 9),
(144, 13160, 'Cantagallo', 9),
(145, 13188, 'Cicuco', 9),
(146, 13212, 'Córdoba', 9),
(147, 13222, 'Clemencia', 9),
(148, 13248, 'El Guamo', 9),
(149, 13430, 'Magangué', 9),
(150, 13433, 'Mahates', 9),
(151, 13440, 'Margarita', 9),
(152, 13458, 'Montecristo', 9),
(153, 13468, 'Mompós', 9),
(154, 13473, 'Morales', 9),
(155, 13490, 'Norosí', 9),
(156, 13549, 'Pinillos', 9),
(157, 13580, 'Regidor', 9),
(158, 13600, 'Río Viejo', 9),
(159, 13647, 'San Estanislao', 9),
(160, 13650, 'San Fernando', 9),
(161, 13657, 'San Juan Nepomuceno', 9),
(162, 13673, 'Santa Catalina', 9),
(163, 13683, 'Santa Rosa', 9),
(164, 13744, 'Simití', 9),
(165, 13760, 'Soplaviento', 9),
(166, 13780, 'Talaigua Nuevo', 9),
(167, 13810, 'Tiquisio', 9),
(168, 13836, 'Turbaco', 9),
(169, 13838, 'Turbaná', 9),
(170, 13873, 'Villanueva', 9),
(171, 15001, 'Tunja', 2),
(172, 15022, 'Almeida', 2),
(173, 15047, 'Aquitania', 2),
(174, 15051, 'Arcabuco', 2),
(175, 15090, 'Berbeo', 2),
(176, 15092, 'Betéitiva', 2),
(177, 15097, 'Boavita', 2),
(178, 15104, 'Boyacá', 2),
(179, 15106, 'Briceño', 2),
(180, 15109, 'Buena Vista', 2),
(181, 15114, 'Busbanzá', 2),
(182, 15131, 'Caldas', 2),
(183, 15135, 'Campohermoso', 2),
(184, 15162, 'Cerinza', 2),
(185, 15172, 'Chinavita', 2),
(186, 15176, 'Chiquinquirá', 2),
(187, 15180, 'Chiscas', 2),
(188, 15183, 'Chita', 2),
(189, 15185, 'Chitaraque', 2),
(190, 15187, 'Chivatá', 2),
(191, 15204, 'Cómbita', 2),
(192, 15212, 'Coper', 2),
(193, 15215, 'Corrales', 2),
(194, 15218, 'Covarachía', 2),
(195, 15223, 'Cubará', 2),
(196, 15224, 'Cucaita', 2),
(197, 15226, 'Cuítiva', 2),
(198, 15232, 'Chíquiza', 2),
(199, 15236, 'Chivor', 2),
(200, 15238, 'Duitama', 2),
(201, 15244, 'El Cocuy', 2),
(202, 15248, 'El Espino', 2),
(203, 15272, 'Firavitoba', 2),
(204, 15276, 'Floresta', 2),
(205, 15293, 'Gachantivá', 2),
(206, 15296, 'Gameza', 2),
(207, 15299, 'Garagoa', 2),
(208, 15317, 'Guacamayas', 2),
(209, 15322, 'Guateque', 2),
(210, 15325, 'Guayatá', 2),
(211, 15332, 'Güicán', 2),
(212, 15362, 'Iza', 2),
(213, 15367, 'Jenesano', 2),
(214, 15368, 'Jericó', 2),
(215, 15377, 'Labranzagrande', 2),
(216, 15380, 'La Capilla', 2),
(217, 15401, 'La Victoria', 2),
(218, 15425, 'Macanal', 2),
(219, 15442, 'Maripí', 2),
(220, 15455, 'Miraflores', 2),
(221, 15464, 'Mongua', 2),
(222, 15466, 'Monguí', 2),
(223, 15469, 'Moniquirá', 2),
(224, 15480, 'Muzo', 2),
(225, 15491, 'Nobsa', 2),
(226, 15494, 'Nuevo Colón', 2),
(227, 15500, 'Oicatá', 2),
(228, 15507, 'Otanche', 2),
(229, 15511, 'Pachavita', 2),
(230, 15514, 'Páez', 2),
(231, 15516, 'Paipa', 2),
(232, 15518, 'Pajarito', 2),
(233, 15522, 'Panqueba', 2),
(234, 15531, 'Pauna', 2),
(235, 15533, 'Paya', 2),
(236, 15542, 'Pesca', 2),
(237, 15550, 'Pisba', 2),
(238, 15572, 'Puerto Boyacá', 2),
(239, 15580, 'Quípama', 2),
(240, 15599, 'Ramiriquí', 2),
(241, 15600, 'Ráquira', 2),
(242, 15621, 'Rondón', 2),
(243, 15632, 'Saboyá', 2),
(244, 15638, 'Sáchica', 2),
(245, 15646, 'Samacá', 2),
(246, 15660, 'San Eduardo', 2),
(247, 15673, 'San Mateo', 2),
(248, 15686, 'Santana', 2),
(249, 15690, 'Santa María', 2),
(250, 15696, 'Santa Sofía', 2),
(251, 15720, 'Sativanorte', 2),
(252, 15723, 'Sativasur', 2),
(253, 15740, 'Siachoque', 2),
(254, 15753, 'Soatá', 2),
(255, 15755, 'Socotá', 2),
(256, 15757, 'Socha', 2),
(257, 15759, 'Sogamoso', 2),
(258, 15761, 'Somondoco', 2),
(259, 15762, 'Sora', 2),
(260, 15763, 'Sotaquirá', 2),
(261, 15764, 'Soracá', 2),
(262, 15774, 'Susacón', 2),
(263, 15776, 'Sutamarchán', 2),
(264, 15778, 'Sutatenza', 2),
(265, 15790, 'Tasco', 2),
(266, 15798, 'Tenza', 2),
(267, 15804, 'Tibaná', 2),
(268, 15808, 'Tinjacá', 2),
(269, 15810, 'Tipacoque', 2),
(270, 15814, 'Toca', 2),
(271, 15820, 'Tópaga', 2),
(272, 15822, 'Tota', 2),
(273, 15835, 'Turmequé', 2),
(274, 15839, 'Tutazá', 2),
(275, 15842, 'Umbita', 2),
(276, 15861, 'Ventaquemada', 2),
(277, 15879, 'Viracachá', 2),
(278, 15897, 'Zetaquira', 2),
(279, 17001, 'Manizales', 10),
(280, 17013, 'Aguadas', 10),
(281, 17042, 'Anserma', 10),
(282, 17050, 'Aranzazu', 10),
(283, 17088, 'Belalcázar', 10),
(284, 17174, 'Chinchiná', 10),
(285, 17272, 'Filadelfia', 10),
(286, 17380, 'La Dorada', 10),
(287, 17388, 'La Merced', 10),
(288, 17433, 'Manzanares', 10),
(289, 17442, 'Marmato', 10),
(290, 17446, 'Marulanda', 10),
(291, 17486, 'Neira', 10),
(292, 17495, 'Norcasia', 10),
(293, 17513, 'Pácora', 10),
(294, 17524, 'Palestina', 10),
(295, 17541, 'Pensilvania', 10),
(296, 17614, 'Riosucio', 10),
(297, 17616, 'Risaralda', 10),
(298, 17653, 'Salamina', 10),
(299, 17662, 'Samaná', 10),
(300, 17665, 'San José', 10),
(301, 17777, 'Supía', 10),
(302, 17867, 'Victoria', 10),
(303, 17873, 'Villamaría', 10),
(304, 17877, 'Viterbo', 10),
(305, 18001, 'Florencia', 11),
(306, 18029, 'Albania', 11),
(307, 18205, 'Curillo', 11),
(308, 18247, 'El Doncello', 11),
(309, 18256, 'El Paujil', 11),
(310, 18479, 'Morelia', 11),
(311, 18592, 'Puerto Rico', 11),
(312, 18756, 'Solano', 11),
(313, 18785, 'Solita', 11),
(314, 18860, 'Valparaíso', 11),
(315, 19001, 'Popayán', 12),
(316, 19022, 'Almaguer', 12),
(317, 19050, 'Argelia', 12),
(318, 19075, 'Balboa', 12),
(319, 19100, 'Bolívar', 12),
(320, 19110, 'Buenos Aires', 12),
(321, 19130, 'Cajibío', 12),
(322, 19137, 'Caldono', 12),
(323, 19142, 'Caloto', 12),
(324, 19212, 'Corinto', 12),
(325, 19256, 'El Tambo', 12),
(326, 19290, 'Florencia', 12),
(327, 19300, 'Guachené', 12),
(328, 19318, 'Guapi', 12),
(329, 19355, 'Inzá', 12),
(330, 19364, 'Jambaló', 12),
(331, 19392, 'La Sierra', 12),
(332, 19397, 'La Vega', 12),
(333, 19418, 'López', 12),
(334, 19450, 'Mercaderes', 12),
(335, 19455, 'Miranda', 12),
(336, 19473, 'Morales', 12),
(337, 19513, 'Padilla', 12),
(338, 19532, 'Patía', 12),
(339, 19533, 'Piamonte', 12),
(340, 19548, 'Piendamó', 12),
(341, 19573, 'Puerto Tejada', 12),
(342, 19585, 'Puracé', 12),
(343, 19622, 'Rosas', 12),
(344, 19701, 'Santa Rosa', 12),
(345, 19743, 'Silvia', 12),
(346, 19760, 'Sotara', 12),
(347, 19780, 'Suárez', 12),
(348, 19785, 'Sucre', 12),
(349, 19807, 'Timbío', 12),
(350, 19809, 'Timbiquí', 12),
(351, 19821, 'Toribio', 12),
(352, 19824, 'Totoró', 12),
(353, 19845, 'Villa Rica', 12),
(354, 20001, 'Valledupar', 13),
(355, 20011, 'Aguachica', 13),
(356, 20013, 'Agustín Codazzi', 13),
(357, 20032, 'Astrea', 13),
(358, 20045, 'Becerril', 13),
(359, 20060, 'Bosconia', 13),
(360, 20175, 'Chimichagua', 13),
(361, 20178, 'Chiriguaná', 13),
(362, 20228, 'Curumaní', 13),
(363, 20238, 'El Copey', 13),
(364, 20250, 'El Paso', 13),
(365, 20295, 'Gamarra', 13),
(366, 20310, 'González', 13),
(367, 20383, 'La Gloria', 13),
(368, 20443, 'Manaure', 13),
(369, 20517, 'Pailitas', 13),
(370, 20550, 'Pelaya', 13),
(371, 20570, 'Pueblo Bello', 13),
(372, 20621, 'La Paz', 13),
(373, 20710, 'San Alberto', 13),
(374, 20750, 'San Diego', 13),
(375, 20770, 'San Martín', 13),
(376, 20787, 'Tamalameque', 13),
(377, 23001, 'Montería', 3),
(378, 23068, 'Ayapel', 3),
(379, 23079, 'Buenavista', 3),
(380, 23090, 'Canalete', 3),
(381, 23162, 'Cereté', 3),
(382, 23168, 'Chimá', 3),
(383, 23182, 'Chinú', 3),
(384, 23300, 'Cotorra', 3),
(385, 23417, 'Lorica', 3),
(386, 23419, 'Los Córdobas', 3),
(387, 23464, 'Momil', 3),
(388, 23500, 'Moñitos', 3),
(389, 23555, 'Planeta Rica', 3),
(390, 23570, 'Pueblo Nuevo', 3),
(391, 23574, 'Puerto Escondido', 3),
(392, 23586, 'Purísima', 3),
(393, 23660, 'Sahagún', 3),
(394, 23670, 'San Andrés Sotavento', 3),
(395, 23672, 'San Antero', 3),
(396, 23686, 'San Pelayo', 3),
(397, 23807, 'Tierralta', 3),
(398, 23815, 'Tuchín', 3),
(399, 23855, 'Valencia', 3),
(400, 25035, 'Anapoima', 14),
(401, 25053, 'Arbeláez', 14),
(402, 25086, 'Beltrán', 14),
(403, 25095, 'Bituima', 14),
(404, 25099, 'Bojacá', 14),
(405, 25120, 'Cabrera', 14),
(406, 25123, 'Cachipay', 14),
(407, 25126, 'Cajicá', 14),
(408, 25148, 'Caparrapí', 14),
(409, 25151, 'Caqueza', 14),
(410, 25168, 'Chaguaní', 14),
(411, 25178, 'Chipaque', 14),
(412, 25181, 'Choachí', 14),
(413, 25183, 'Chocontá', 14),
(414, 25200, 'Cogua', 14),
(415, 25214, 'Cota', 14),
(416, 25224, 'Cucunubá', 14),
(417, 25245, 'El Colegio', 14),
(418, 25260, 'El Rosal', 14),
(419, 25279, 'Fomeque', 14),
(420, 25281, 'Fosca', 14),
(421, 25286, 'Funza', 14),
(422, 25288, 'Fúquene', 14),
(423, 25293, 'Gachala', 14),
(424, 25295, 'Gachancipá', 14),
(425, 25297, 'Gachetá', 14),
(426, 25307, 'Girardot', 14),
(427, 25312, 'Granada', 14),
(428, 25317, 'Guachetá', 14),
(429, 25320, 'Guaduas', 14),
(430, 25322, 'Guasca', 14),
(431, 25324, 'Guataquí', 14),
(432, 25326, 'Guatavita', 14),
(433, 25335, 'Guayabetal', 14),
(434, 25339, 'Gutiérrez', 14),
(435, 25368, 'Jerusalén', 14),
(436, 25372, 'Junín', 14),
(437, 25377, 'La Calera', 14),
(438, 25386, 'La Mesa', 14),
(439, 25394, 'La Palma', 14),
(440, 25398, 'La Peña', 14),
(441, 25402, 'La Vega', 14),
(442, 25407, 'Lenguazaque', 14),
(443, 25426, 'Macheta', 14),
(444, 25430, 'Madrid', 14),
(445, 25436, 'Manta', 14),
(446, 25438, 'Medina', 14),
(447, 25473, 'Mosquera', 14),
(448, 25483, 'Nariño', 14),
(449, 25486, 'Nemocón', 14),
(450, 25488, 'Nilo', 14),
(451, 25489, 'Nimaima', 14),
(452, 25491, 'Nocaima', 14),
(453, 25506, 'Venecia', 14),
(454, 25513, 'Pacho', 14),
(455, 25518, 'Paime', 14),
(456, 25524, 'Pandi', 14),
(457, 25530, 'Paratebueno', 14),
(458, 25535, 'Pasca', 14),
(459, 25572, 'Puerto Salgar', 14),
(460, 25580, 'Pulí', 14),
(461, 25592, 'Quebradanegra', 14),
(462, 25594, 'Quetame', 14),
(463, 25596, 'Quipile', 14),
(464, 25599, 'Apulo', 14),
(465, 25612, 'Ricaurte', 14),
(466, 25649, 'San Bernardo', 14),
(467, 25653, 'San Cayetano', 14),
(468, 25658, 'San Francisco', 14),
(469, 25736, 'Sesquilé', 14),
(470, 25740, 'Sibaté', 14),
(471, 25743, 'Silvania', 14),
(472, 25745, 'Simijaca', 14),
(473, 25754, 'Soacha', 14),
(474, 25769, 'Subachoque', 14),
(475, 25772, 'Suesca', 14),
(476, 25777, 'Supatá', 14),
(477, 25779, 'Susa', 14),
(478, 25781, 'Sutatausa', 14),
(479, 25785, 'Tabio', 14),
(480, 25793, 'Tausa', 14),
(481, 25797, 'Tena', 14),
(482, 25799, 'Tenjo', 14),
(483, 25805, 'Tibacuy', 14),
(484, 25807, 'Tibirita', 14),
(485, 25815, 'Tocaima', 14),
(486, 25817, 'Tocancipá', 14),
(487, 25823, 'Topaipí', 14),
(488, 25839, 'Ubalá', 14),
(489, 25841, 'Ubaque', 14),
(490, 25845, 'Une', 14),
(491, 25851, 'Útica', 14),
(492, 25867, 'Vianí', 14),
(493, 25871, 'Villagómez', 14),
(494, 25873, 'Villapinzón', 14),
(495, 25875, 'Villeta', 14),
(496, 25878, 'Viotá', 14),
(497, 25898, 'Zipacón', 14),
(498, 27001, 'Quibdó', 4),
(499, 27006, 'Acandí', 4),
(500, 27025, 'Alto Baudo', 4),
(501, 27050, 'Atrato', 4),
(502, 27073, 'Bagadó', 4),
(503, 27075, 'Bahía Solano', 4),
(504, 27077, 'Bajo Baudó', 4),
(505, 27099, 'Bojaya', 4),
(506, 27160, 'Cértegui', 4),
(507, 27205, 'Condoto', 4),
(508, 27372, 'Juradó', 4),
(509, 27413, 'Lloró', 4),
(510, 27425, 'Medio Atrato', 4),
(511, 27430, 'Medio Baudó', 4),
(512, 27450, 'Medio San Juan', 4),
(513, 27491, 'Nóvita', 4),
(514, 27495, 'Nuquí', 4),
(515, 27580, 'Río Iro', 4),
(516, 27600, 'Río Quito', 4),
(517, 27615, 'Riosucio', 4),
(518, 27745, 'Sipí', 4),
(519, 27800, 'Unguía', 4),
(520, 41001, 'Neiva', 15),
(521, 41006, 'Acevedo', 15),
(522, 41013, 'Agrado', 15),
(523, 41016, 'Aipe', 15),
(524, 41020, 'Algeciras', 15),
(525, 41026, 'Altamira', 15),
(526, 41078, 'Baraya', 15),
(527, 41132, 'Campoalegre', 15),
(528, 41206, 'Colombia', 15),
(529, 41244, 'Elías', 15),
(530, 41298, 'Garzón', 15),
(531, 41306, 'Gigante', 15),
(532, 41319, 'Guadalupe', 15),
(533, 41349, 'Hobo', 15),
(534, 41357, 'Iquira', 15),
(535, 41359, 'Isnos', 15),
(536, 41378, 'La Argentina', 15),
(537, 41396, 'La Plata', 15),
(538, 41483, 'Nátaga', 15),
(539, 41503, 'Oporapa', 15),
(540, 41518, 'Paicol', 15),
(541, 41524, 'Palermo', 15),
(542, 41530, 'Palestina', 15),
(543, 41548, 'Pital', 15),
(544, 41551, 'Pitalito', 15),
(545, 41615, 'Rivera', 15),
(546, 41660, 'Saladoblanco', 15),
(547, 41676, 'Santa María', 15),
(548, 41770, 'Suaza', 15),
(549, 41791, 'Tarqui', 15),
(550, 41797, 'Tesalia', 15),
(551, 41799, 'Tello', 15),
(552, 41801, 'Teruel', 15),
(553, 41807, 'Timaná', 15),
(554, 41872, 'Villavieja', 15),
(555, 41885, 'Yaguará', 15),
(556, 44001, 'Riohacha', 16),
(557, 44035, 'Albania', 16),
(558, 44078, 'Barrancas', 16),
(559, 44090, 'Dibula', 16),
(560, 44098, 'Distracción', 16),
(561, 44110, 'El Molino', 16),
(562, 44279, 'Fonseca', 16),
(563, 44378, 'Hatonuevo', 16),
(564, 44430, 'Maicao', 16),
(565, 44560, 'Manaure', 16),
(566, 44847, 'Uribia', 16),
(567, 44855, 'Urumita', 16),
(568, 44874, 'Villanueva', 16),
(569, 47001, 'Santa Marta', 17),
(570, 47030, 'Algarrobo', 17),
(571, 47053, 'Aracataca', 17),
(572, 47058, 'Ariguaní', 17),
(573, 47161, 'Cerro San Antonio', 17),
(574, 47170, 'Chivolo', 17),
(575, 47205, 'Concordia', 17),
(576, 47245, 'El Banco', 17),
(577, 47258, 'El Piñon', 17),
(578, 47268, 'El Retén', 17),
(579, 47288, 'Fundación', 17),
(580, 47318, 'Guamal', 17),
(581, 47460, 'Nueva Granada', 17),
(582, 47541, 'Pedraza', 17),
(583, 47551, 'Pivijay', 17),
(584, 47555, 'Plato', 17),
(585, 47605, 'Remolino', 17),
(586, 47675, 'Salamina', 17),
(587, 47703, 'San Zenón', 17),
(588, 47707, 'Santa Ana', 17),
(589, 47745, 'Sitionuevo', 17),
(590, 47798, 'Tenerife', 17),
(591, 47960, 'Zapayán', 17),
(592, 47980, 'Zona Bananera', 17),
(593, 50001, 'Villavicencio', 7),
(594, 50006, 'Acacias', 7),
(595, 50124, 'Cabuyaro', 7),
(596, 50223, 'Cubarral', 7),
(597, 50226, 'Cumaral', 7),
(598, 50245, 'El Calvario', 7),
(599, 50251, 'El Castillo', 7),
(600, 50270, 'El Dorado', 7),
(601, 50313, 'Granada', 7),
(602, 50318, 'Guamal', 7),
(603, 50325, 'Mapiripán', 7),
(604, 50330, 'Mesetas', 7),
(605, 50350, 'La Macarena', 7),
(606, 50400, 'Lejanías', 7),
(607, 50450, 'Puerto Concordia', 7),
(608, 50568, 'Puerto Gaitán', 7),
(609, 50573, 'Puerto López', 7),
(610, 50577, 'Puerto Lleras', 7),
(611, 50590, 'Puerto Rico', 7),
(612, 50606, 'Restrepo', 7),
(613, 50686, 'San Juanito', 7),
(614, 50689, 'San Martín', 7),
(615, 50711, 'Vista Hermosa', 7),
(616, 52001, 'Pasto', 5),
(617, 52019, 'Albán', 5),
(618, 52022, 'Aldana', 5),
(619, 52036, 'Ancuyá', 5),
(620, 52079, 'Barbacoas', 5),
(621, 52203, 'Colón', 5),
(622, 52207, 'Consaca', 5),
(623, 52210, 'Contadero', 5),
(624, 52215, 'Córdoba', 5),
(625, 52224, 'Cuaspud', 5),
(626, 52227, 'Cumbal', 5),
(627, 52233, 'Cumbitara', 5),
(628, 52250, 'El Charco', 5),
(629, 52254, 'El Peñol', 5),
(630, 52256, 'El Rosario', 5),
(631, 52260, 'El Tambo', 5),
(632, 52287, 'Funes', 5),
(633, 52317, 'Guachucal', 5),
(634, 52320, 'Guaitarilla', 5),
(635, 52323, 'Gualmatán', 5),
(636, 52352, 'Iles', 5),
(637, 52354, 'Imués', 5),
(638, 52356, 'Ipiales', 5),
(639, 52378, 'La Cruz', 5),
(640, 52381, 'La Florida', 5),
(641, 52385, 'La Llanada', 5),
(642, 52390, 'La Tola', 5),
(643, 52399, 'La Unión', 5),
(644, 52405, 'Leiva', 5),
(645, 52411, 'Linares', 5),
(646, 52418, 'Los Andes', 5),
(647, 52427, 'Magüí', 5),
(648, 52435, 'Mallama', 5),
(649, 52473, 'Mosquera', 5),
(650, 52480, 'Nariño', 5),
(651, 52490, 'Olaya Herrera', 5),
(652, 52506, 'Ospina', 5),
(653, 52520, 'Francisco Pizarro', 5),
(654, 52540, 'Policarpa', 5),
(655, 52560, 'Potosí', 5),
(656, 52565, 'Providencia', 5),
(657, 52573, 'Puerres', 5),
(658, 52585, 'Pupiales', 5),
(659, 52612, 'Ricaurte', 5),
(660, 52621, 'Roberto Payán', 5),
(661, 52678, 'Samaniego', 5),
(662, 52683, 'Sandoná', 5),
(663, 52685, 'San Bernardo', 5),
(664, 52687, 'San Lorenzo', 5),
(665, 52693, 'San Pablo', 5),
(666, 52696, 'Santa Bárbara', 5),
(667, 52720, 'Sapuyes', 5),
(668, 52786, 'Taminango', 5),
(669, 52788, 'Tangua', 5),
(670, 52838, 'Túquerres', 5),
(671, 52885, 'Yacuanquer', 5),
(672, 63001, 'Armenia', 18),
(673, 63111, 'Buenavista', 18),
(674, 63190, 'Circasia', 18),
(675, 63212, 'Córdoba', 18),
(676, 63272, 'Filandia', 18),
(677, 63401, 'La Tebaida', 18),
(678, 63470, 'Montenegro', 18),
(679, 63548, 'Pijao', 18),
(680, 63594, 'Quimbaya', 18),
(681, 63690, 'Salento', 18),
(682, 66001, 'Pereira', 19),
(683, 66045, 'Apía', 19),
(684, 66075, 'Balboa', 19),
(685, 66170, 'Dosquebradas', 19),
(686, 66318, 'Guática', 19),
(687, 66383, 'La Celia', 19),
(688, 66400, 'La Virginia', 19),
(689, 66440, 'Marsella', 19),
(690, 66456, 'Mistrató', 19),
(691, 66572, 'Pueblo Rico', 19),
(692, 66594, 'Quinchía', 19),
(693, 66687, 'Santuario', 19),
(694, 68001, 'Bucaramanga', 6),
(695, 68013, 'Aguada', 6),
(696, 68020, 'Albania', 6),
(697, 68051, 'Aratoca', 6),
(698, 68077, 'Barbosa', 6),
(699, 68079, 'Barichara', 6),
(700, 68081, 'Barrancabermeja', 6),
(701, 68092, 'Betulia', 6),
(702, 68101, 'Bolívar', 6),
(703, 68121, 'Cabrera', 6),
(704, 68132, 'California', 6),
(705, 68152, 'Carcasí', 6),
(706, 68160, 'Cepitá', 6),
(707, 68162, 'Cerrito', 6),
(708, 68167, 'Charalá', 6),
(709, 68169, 'Charta', 6),
(710, 68179, 'Chipatá', 6),
(711, 68190, 'Cimitarra', 6),
(712, 68207, 'Concepción', 6),
(713, 68209, 'Confines', 6),
(714, 68211, 'Contratación', 6),
(715, 68217, 'Coromoro', 6),
(716, 68229, 'Curití', 6),
(717, 68245, 'El Guacamayo', 6),
(718, 68255, 'El Playón', 6),
(719, 68264, 'Encino', 6),
(720, 68266, 'Enciso', 6),
(721, 68271, 'Florián', 6),
(722, 68276, 'Floridablanca', 6),
(723, 68296, 'Galán', 6),
(724, 68298, 'Gambita', 6),
(725, 68307, 'Girón', 6),
(726, 68318, 'Guaca', 6),
(727, 68320, 'Guadalupe', 6),
(728, 68322, 'Guapotá', 6),
(729, 68324, 'Guavatá', 6),
(730, 68327, 'Güepsa', 6),
(731, 68368, 'Jesús María', 6),
(732, 68370, 'Jordán', 6),
(733, 68377, 'La Belleza', 6),
(734, 68385, 'Landázuri', 6),
(735, 68397, 'La Paz', 6),
(736, 68406, 'Lebríja', 6),
(737, 68418, 'Los Santos', 6),
(738, 68425, 'Macaravita', 6),
(739, 68432, 'Málaga', 6),
(740, 68444, 'Matanza', 6),
(741, 68464, 'Mogotes', 6),
(742, 68468, 'Molagavita', 6),
(743, 68498, 'Ocamonte', 6),
(744, 68500, 'Oiba', 6),
(745, 68502, 'Onzaga', 6),
(746, 68522, 'Palmar', 6),
(747, 68533, 'Páramo', 6),
(748, 68547, 'Piedecuesta', 6),
(749, 68549, 'Pinchote', 6),
(750, 68572, 'Puente Nacional', 6),
(751, 68615, 'Rionegro', 6),
(752, 68669, 'San Andrés', 6),
(753, 68679, 'San Gil', 6),
(754, 68682, 'San Joaquín', 6),
(755, 68686, 'San Miguel', 6),
(756, 68705, 'Santa Bárbara', 6),
(757, 68745, 'Simacota', 6),
(758, 68755, 'Socorro', 6),
(759, 68770, 'Suaita', 6),
(760, 68773, 'Sucre', 6),
(761, 68780, 'Suratá', 6),
(762, 68820, 'Tona', 6),
(763, 68861, 'Vélez', 6),
(764, 68867, 'Vetas', 6),
(765, 68872, 'Villanueva', 6),
(766, 68895, 'Zapatoca', 6),
(767, 70001, 'Sincelejo', 20),
(768, 70110, 'Buenavista', 20),
(769, 70124, 'Caimito', 20),
(770, 70204, 'Coloso', 20),
(771, 70221, 'Coveñas', 20),
(772, 70230, 'Chalán', 20),
(773, 70233, 'El Roble', 20),
(774, 70235, 'Galeras', 20),
(775, 70265, 'Guaranda', 20),
(776, 70400, 'La Unión', 20),
(777, 70418, 'Los Palmitos', 20),
(778, 70429, 'Majagual', 20),
(779, 70473, 'Morroa', 20),
(780, 70508, 'Ovejas', 20),
(781, 70523, 'Palmito', 20),
(782, 70678, 'San Benito Abad', 20),
(783, 70708, 'San Marcos', 20),
(784, 70713, 'San Onofre', 20),
(785, 70717, 'San Pedro', 20),
(786, 70771, 'Sucre', 20),
(787, 70823, 'Tolú Viejo', 20),
(788, 73024, 'Alpujarra', 21),
(789, 73026, 'Alvarado', 21),
(790, 73030, 'Ambalema', 21),
(791, 73055, 'Armero', 21),
(792, 73067, 'Ataco', 21),
(793, 73124, 'Cajamarca', 21),
(794, 73168, 'Chaparral', 21),
(795, 73200, 'Coello', 21),
(796, 73217, 'Coyaima', 21),
(797, 73226, 'Cunday', 21),
(798, 73236, 'Dolores', 21),
(799, 73268, 'Espinal', 21),
(800, 73270, 'Falan', 21),
(801, 73275, 'Flandes', 21),
(802, 73283, 'Fresno', 21),
(803, 73319, 'Guamo', 21),
(804, 73347, 'Herveo', 21),
(805, 73349, 'Honda', 21),
(806, 73352, 'Icononzo', 21),
(807, 73443, 'Mariquita', 21),
(808, 73449, 'Melgar', 21),
(809, 73461, 'Murillo', 21),
(810, 73483, 'Natagaima', 21),
(811, 73504, 'Ortega', 21),
(812, 73520, 'Palocabildo', 21),
(813, 73547, 'Piedras', 21),
(814, 73555, 'Planadas', 21),
(815, 73563, 'Prado', 21),
(816, 73585, 'Purificación', 21),
(817, 73616, 'Rio Blanco', 21),
(818, 73622, 'Roncesvalles', 21),
(819, 73624, 'Rovira', 21),
(820, 73671, 'Saldaña', 21),
(821, 73686, 'Santa Isabel', 21),
(822, 73861, 'Venadillo', 21),
(823, 73870, 'Villahermosa', 21),
(824, 73873, 'Villarrica', 21),
(825, 81065, 'Arauquita', 22),
(826, 81220, 'Cravo Norte', 22),
(827, 81300, 'Fortul', 22),
(828, 81591, 'Puerto Rondón', 22),
(829, 81736, 'Saravena', 22),
(830, 81794, 'Tame', 22),
(831, 81001, 'Arauca', 22),
(832, 85001, 'Yopal', 23),
(833, 85010, 'Aguazul', 23),
(834, 85015, 'Chámeza', 23),
(835, 85125, 'Hato Corozal', 23),
(836, 85136, 'La Salina', 23),
(837, 85162, 'Monterrey', 23),
(838, 85263, 'Pore', 23),
(839, 85279, 'Recetor', 23),
(840, 85300, 'Sabanalarga', 23),
(841, 85315, 'Sácama', 23),
(842, 85410, 'Tauramena', 23),
(843, 85430, 'Trinidad', 23),
(844, 85440, 'Villanueva', 23),
(845, 86001, 'Mocoa', 24),
(846, 86219, 'Colón', 24),
(847, 86320, 'Orito', 24),
(848, 86569, 'Puerto Caicedo', 24),
(849, 86571, 'Puerto Guzmán', 24),
(850, 86573, 'Leguízamo', 24),
(851, 86749, 'Sibundoy', 24),
(852, 86755, 'San Francisco', 24),
(853, 86757, 'San Miguel', 24),
(854, 86760, 'Santiago', 24),
(855, 91001, 'Leticia', 25),
(856, 91263, 'El Encanto', 25),
(857, 91405, 'La Chorrera', 25),
(858, 91407, 'La Pedrera', 25),
(859, 91430, 'La Victoria', 25),
(860, 91536, 'Puerto Arica', 25),
(861, 91540, 'Puerto Nariño', 25),
(862, 91669, 'Puerto Santander', 25),
(863, 91798, 'Tarapacá', 25),
(864, 94001, 'Inírida', 26),
(865, 94343, 'Barranco Minas', 26),
(866, 94663, 'Mapiripana', 26),
(867, 94883, 'San Felipe', 26),
(868, 94884, 'Puerto Colombia', 26),
(869, 94885, 'La Guadalupe', 26),
(870, 94886, 'Cacahual', 26),
(871, 94887, 'Pana Pana', 26),
(872, 94888, 'Morichal', 26),
(873, 99001, 'Puerto Carreño', 27),
(874, 99524, 'La Primavera', 27),
(875, 99624, 'Santa Rosalía', 27),
(876, 99773, 'Cumaribo', 27),
(877, 18610, 'San José Del Fragua', 11),
(878, 50110, 'Barranca De Upía', 7),
(879, 68524, 'Palmas Del Socorro', 6),
(880, 25662, 'San Juan De Río Seco', 14),
(881, 8372, 'Juan De Acosta', 8),
(882, 50287, 'Fuente De Oro', 7),
(883, 85325, 'San Luis De Gaceno', 23),
(884, 27250, 'El Litoral Del San Juan', 4),
(885, 25843, 'Villa De San Diego De Ubate', 14),
(886, 13074, 'Barranco De Loba', 9),
(887, 15816, 'Togüí', 2),
(888, 13688, 'Santa Rosa Del Sur', 9),
(889, 27135, 'El Cantón Del San Pablo', 4),
(890, 15407, 'Villa De Leyva', 2),
(891, 47692, 'San Sebastián De Buenavista', 17),
(892, 15537, 'Paz De Río', 2),
(893, 13300, 'Hatillo De Loba', 9),
(894, 47660, 'Sabanas De San Angel', 17),
(895, 95015, 'Calamar', 28),
(896, 20614, 'Río De Oro', 13),
(897, 5665, 'San Pedro De Uraba', 1),
(898, 95001, 'San José Del Guaviare', 28),
(899, 15693, 'Santa Rosa De Viterbo', 2),
(900, 19698, 'Santander De Quilichao', 12),
(901, 95200, 'Miraflores', 28),
(902, 5042, 'Santafé De Antioquia', 1),
(903, 50680, 'San Carlos De Guaroa', 7),
(904, 8520, 'Palmar De Varela', 8),
(905, 5686, 'Santa Rosa De Osos', 1),
(906, 5647, 'San Andrés De Cuerquía', 1),
(907, 73854, 'Valle De San Juan', 21),
(908, 68689, 'San Vicente De Chucurí', 6),
(909, 68684, 'San José De Miranda', 6),
(910, 88564, 'Providencia', 29),
(911, 66682, 'Santa Rosa De Cabal', 19),
(912, 25328, 'Guayabal De Siquima', 14),
(913, 18094, 'Belén De Los Andaquies', 11),
(914, 85250, 'Paz De Ariporo', 23),
(915, 68720, 'Santa Helena Del Opón', 6),
(916, 15681, 'San Pablo De Borbur', 2),
(917, 44420, 'La Jagua Del Pilar', 16),
(918, 20400, 'La Jagua De Ibirico', 13),
(919, 70742, 'San Luis De Sincé', 20),
(920, 15667, 'San Luis De Gaceno', 2),
(921, 13244, 'El Carmen De Bolívar', 9),
(922, 27245, 'El Carmen De Atrato', 4),
(923, 70702, 'San Juan De Betulia', 20),
(924, 47545, 'Pijiño Del Carmen', 17),
(925, 5873, 'Vigía Del Fuerte', 1),
(926, 13667, 'San Martín De Loba', 9),
(927, 13030, 'Altos Del Rosario', 9),
(928, 73148, 'Carmen De Apicala', 21),
(929, 25645, 'San Antonio Del Tequendama', 14),
(930, 68655, 'Sabana De Torres', 6),
(931, 95025, 'El Retorno', 28),
(932, 23682, 'San José De Uré', 3),
(933, 52694, 'San Pedro De Cartago', 5),
(934, 8137, 'Campo De La Cruz', 8),
(935, 50683, 'San Juan De Arama', 7),
(936, 5658, 'San José De La Montaña', 1),
(937, 18150, 'Cartagena Del Chairá', 11),
(938, 27660, 'San José Del Palmar', 4),
(939, 25001, 'Agua De Dios', 14),
(940, 13655, 'San Jacinto Del Cauca', 9),
(941, 41668, 'San Agustín', 15),
(942, 52258, 'El Tablón De Gómez', 5),
(943, 88001, 'San Andrés', 29),
(944, 15664, 'San José De Pare', 2),
(945, 86865, 'Valle De Guamez', 24),
(946, 13670, 'San Pablo De Borbur', 9),
(947, 70820, 'Santiago De Tolú', 20),
(948, 11001, 'Bogotá D.c.', 30),
(949, 25154, 'Carmen De Carupa', 14),
(950, 23189, 'Ciénaga De Oro', 3),
(951, 5659, 'San Juan De Urabá', 1),
(952, 44650, 'San Juan Del Cesar', 16),
(953, 68235, 'El Carmen De Chucurí', 6),
(954, 5148, 'El Carmen De Viboral', 1),
(955, 66088, 'Belén De Umbría', 19),
(956, 27086, 'Belén De Bajira', 4),
(957, 68855, 'Valle De San José', 6),
(958, 73678, 'San Luis', 21),
(959, 15676, 'San Miguel De Sema', 2),
(960, 73675, 'San Antonio', 21),
(961, 68673, 'San Benito', 6),
(962, 25862, 'Vergara', 14),
(963, 23678, 'San Carlos', 3),
(964, 91530, 'Puerto Alegría', 25),
(965, 68344, 'Hato', 6),
(966, 13654, 'San Jacinto', 9),
(967, 19693, 'San Sebastián', 12),
(968, 5649, 'San Carlos', 1),
(969, 15837, 'Tuta', 2),
(970, 54743, 'Silos', 31),
(971, 54125, 'Cácota', 31),
(972, 76250, 'El Dovio', 32),
(973, 54820, 'Toledo', 31),
(974, 76622, 'Roldanillo', 32),
(975, 54480, 'Mutiscua', 31),
(976, 76054, 'Argelia', 32),
(977, 54261, 'El Zulia', 31),
(978, 54660, 'Salazar', 31),
(979, 76736, 'Sevilla', 32),
(980, 76895, 'Zarzal', 32),
(981, 54223, 'Cucutilla', 31),
(982, 76248, 'El Cerrito', 32),
(983, 76147, 'Cartago', 32),
(984, 76122, 'Caicedonia', 32),
(985, 54553, 'Puerto Santander', 31),
(986, 54313, 'Gramalote', 31),
(987, 76246, 'El Cairo', 32),
(988, 54250, 'El Tarra', 31),
(989, 76400, 'La Unión', 32),
(990, 76606, 'Restrepo', 32),
(991, 54800, 'Teorama', 31),
(992, 76233, 'Dagua', 32),
(993, 54051, 'Arboledas', 31),
(994, 76318, 'Guacarí', 32),
(995, 54418, 'Lourdes', 31),
(996, 76041, 'Ansermanuevo', 32),
(997, 54099, 'Bochalema', 31),
(998, 76113, 'Bugalagrande', 32),
(999, 54206, 'Convención', 31),
(1000, 54344, 'Hacarí', 31),
(1001, 76403, 'La Victoria', 32),
(1002, 54347, 'Herrán', 31),
(1003, 76306, 'Ginebra', 32),
(1004, 76892, 'Yumbo', 32),
(1005, 76497, 'Obando', 32),
(1006, 54810, 'Tibú', 31),
(1007, 54673, 'San Cayetano', 31),
(1008, 54670, 'San Calixto', 31),
(1009, 76100, 'Bolívar', 32),
(1010, 54398, 'La Playa', 31),
(1011, 76001, 'Cali', 32),
(1012, 76670, 'San Pedro', 32),
(1013, 76111, 'Guadalajara De Buga', 32),
(1014, 54172, 'Chinácota', 31),
(1015, 54599, 'Ragonvalia', 31),
(1016, 54385, 'La Esperanza', 31),
(1017, 54874, 'Villa Del Rosario', 31),
(1018, 54174, 'Chitagá', 31),
(1019, 76126, 'Calima', 32),
(1020, 54720, 'Sardinata', 31),
(1021, 76036, 'Andalucía', 32),
(1022, 76563, 'Pradera', 32),
(1023, 54003, 'Abrego', 31),
(1024, 54405, 'Los Patios', 31),
(1025, 54498, 'Ocaña', 31),
(1026, 54109, 'Bucarasica', 31),
(1027, 76890, 'Yotoco', 32),
(1028, 76520, 'Palmira', 32),
(1029, 76616, 'Riofrío', 32),
(1030, 54680, 'Santiago', 31),
(1031, 76020, 'Alcalá', 32),
(1032, 76863, 'Versalles', 32),
(1033, 54377, 'Labateca', 31),
(1034, 54128, 'Cachirá', 31),
(1035, 54871, 'Villa Caro', 31),
(1036, 54239, 'Durania', 31),
(1037, 76243, 'El Águila', 32),
(1038, 76823, 'Toro', 32),
(1039, 76130, 'Candelaria', 32),
(1040, 76377, 'La Cumbre', 32),
(1041, 76845, 'Ulloa', 32),
(1042, 76828, 'Trujillo', 32),
(1043, 76869, 'Vijes', 32),
(1044, 68176, 'Chimá', 6),
(1045, 70670, 'Sampués', 20),
(1046, 85225, 'Nunchía', 23),
(1047, 54518, 'Pamplona', 31),
(1048, 25019, 'Albán', 14),
(1049, 23466, 'Montelíbano', 3),
(1050, 86568, 'Puerto Asís', 24),
(1051, 70215, 'Corozal', 20),
(1052, 52110, 'Buesaco', 5),
(1053, 85139, 'Maní', 23),
(1054, 13268, 'El Peñón', 9),
(1055, 76834, 'Tuluá', 32),
(1056, 73152, 'Casabianca', 21),
(1057, 25040, 'Anolaima', 14),
(1058, 25175, 'Chía', 14),
(1059, 52835, 'San Andrés De Tumaco', 5),
(1060, 18460, 'Milán', 11),
(1061, 68147, 'Capitanejo', 6),
(1062, 73043, 'Anzoátegui', 21),
(1063, 76275, 'Florida', 32),
(1064, 8606, 'Repelón', 8),
(1065, 5284, 'Frontino', 1),
(1066, 25258, 'El Peñón', 14),
(1067, 54520, 'Pamplonita', 31),
(1068, 91460, 'Miriti Paraná', 25),
(1069, 85400, 'Támara', 23),
(1070, 15806, 'Tibasosa', 2),
(1071, 19517, 'Páez', 12),
(1072, 73001, 'Ibagué', 21),
(1073, 8573, 'Puerto Colombia', 8),
(1074, 52083, 'Belén', 5),
(1075, 25758, 'Sopó', 14),
(1076, 27150, 'Carmen Del Darien', 4),
(1077, 25299, 'Gama', 14),
(1078, 25718, 'Sasaima', 14),
(1079, 52240, 'Chachagüí', 5),
(1080, 54001, 'Cúcuta', 31),
(1081, 13001, 'Cartagena', 9),
(1082, 5313, 'Granada', 1),
(1083, 47720, 'Santa Bárbara De Pinto', 17),
(1084, 13442, 'María La Baja', 9),
(1085, 18410, 'La Montañita', 11),
(1086, 18753, 'San Vicente Del Caguán', 11),
(1087, 68250, 'El Peñón', 6),
(1088, 5364, 'Jardín', 1),
(1089, 76364, 'Jamundí', 32),
(1090, 27787, 'Tadó', 4),
(1091, 85230, 'Orocué', 23),
(1092, 73411, 'Líbano', 21),
(1093, 25885, 'Yacopí', 14),
(1094, 63130, 'Calarcá', 18),
(1095, 5756, 'Sonsón', 1),
(1096, 54245, 'El Carmen', 31),
(1097, 73408, 'Lérida', 21),
(1098, 23350, 'La Apartada', 3),
(1099, 13620, 'San Cristóbal', 9),
(1100, 25290, 'Fusagasugá', 14),
(1101, 13894, 'Zambrano', 9),
(1102, 15403, 'La Uvita', 2),
(1103, 25899, 'Zipaquirá', 14),
(1104, 63302, 'Génova', 18),
(1105, 73770, 'Suárez', 21),
(1106, 50150, 'Castilla La Nueva', 7),
(1107, 15087, 'Belén', 2),
(1108, 27810, 'Unión Panamericana', 4),
(1109, 47570, 'Pueblo Viejo', 17),
(1110, 86885, 'Villagarzón', 24),
(1111, 25269, 'Facatativá', 14),
(1112, 23580, 'Puerto Libertador', 3),
(1113, 17444, 'Marquetalia', 10),
(1114, 52051, 'Arboleda', 5),
(1115, 76109, 'Buenaventura', 32),
(1116, 47189, 'Ciénaga', 17),
(1117, 8560, 'Ponedera', 8),
(1118, 97001, 'Mitu', 33),
(1119, 97161, 'CarurÚ', 33),
(1120, 97511, 'Pacoa (cor. Departamental)', 33),
(1121, 97666, 'Taraira', 33),
(1122, 97777, 'Papunaua (cor. Departamental)', 33),
(1123, 97889, 'YabaratÉ', 33),
(1124, 51342, 'Campamento', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
