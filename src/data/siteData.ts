export type PageRoute = 'home' | 'about' | 'products' | 'services' | 'contact';

export type ProductCategory =
  | 'Sliding Table Saws'
  | 'Edgebanding Machines'
  | 'Saw Blades'
  | 'Sizing Tools'
  | 'Planing Tools'
  | 'Profiling Tools'
  | 'Minifinger Joint Cutters'
  | 'Shank Tools'
  | 'Sawmills';

export type SawmillSubcategory =
  | 'Portable Sawmill'
  | 'Industrial Sawmills'
  | 'Vertical Sawmills';

export interface ProductItem {
  id: string;
  name: string;
  brand: 'Altendorf' | 'Leitz' | 'Wood-Mizer';
  category: ProductCategory;
  subcategory?: SawmillSubcategory;
  tagline?: string;
  description: string;
  image: string;
  highlights: string[];
  featured?: boolean;
}

export interface ServiceItem {
  id: string;
  number: string;
  title: string;
  description: string;
  capabilities: string[];
  categoryLink: ProductCategory | 'All';
}

export interface HeroSlide {
  id: string;
  kicker: string;
  title: string;
  subtitle: string;
  ctaLabel: string;
  ctaTarget: PageRoute;
  ctaCategory?: ProductCategory;
  imageKey: 'heroWoodworking' | 'heroSawmill' | 'heroTooling';
  partnerLabel: string;
}

export const COMPANY_INFO = {
  name: 'Serendib Tools & Machineries (Pvt) Ltd.',
  shortName: 'Serendib Tools',
  tagline: 'Believe in Quality',
  established: '2019–2020',
  phoneDisplay: '+94 0777316002',
  phoneCompact: '+94 77 731 6002',
  phoneHref: 'tel:+94777316002',
  whatsappNumber: '94777316002',
  email: 'info@serendibtools.lk',
  locationShort: 'Kesbawa, Sri Lanka',
  address: 'No 202/B Kesbewa-Kindelpitiya-Bandaragama Rd, Kesbawa, Sri Lanka',
  coordinates: {
    lat: 6.7944,
    lng: 79.9412,
  },
  hours: 'Mon-Fri: 8:00 AM – 6:00 PM | Sat: 8:00 AM – 2:00 PM',
  mapsUrl:
    'https://www.google.com/maps/search/?api=1&query=No+202%2FB+Kesbewa-Kindelpitiya-Bandaragama+Rd,+Kesbawa,+Sri+Lanka',
  social: [
    { name: 'Facebook', href: 'https://www.facebook.com/' },
    { name: 'X (Twitter)', href: 'https://x.com/' },
    { name: 'Instagram', href: 'https://www.instagram.com/' },
    { name: 'LinkedIn', href: 'https://www.linkedin.com/' },
    { name: 'YouTube', href: 'https://www.youtube.com/' },
  ],
};

export const TRUST_GUARANTEES = [
  'ISO Certified Machinery',
  'Island-Wide Delivery',
  'Free Installation',
  'After-Sales Warranty',
  '24/7 Technical Support',
];

export const HERO_SLIDES: HeroSlide[] = [
  {
    id: 'slide-altendorf',
    kicker: 'Precision Woodworking Machinery',
    title: 'World-Leading German Panel Saws & Edgebanders',
    subtitle:
      'Authorized partner for Altendorf sliding table saws and edgebanding machines, backed by free installation and certified engineering support across Sri Lanka.',
    ctaLabel: 'Explore Panel Saws',
    ctaTarget: 'products',
    ctaCategory: 'Sliding Table Saws',
    imageKey: 'heroWoodworking',
    partnerLabel: 'Altendorf Authorized Partner',
  },
  {
    id: 'slide-sawmills',
    kicker: 'Timber Processing Solutions',
    title: 'High-Yield Portable & Industrial Sawmills',
    subtitle:
      'From Wood-Mizer LX series portable mills to heavy-duty twin vertical breakdown lines engineered to maximize hardwood and tropical log recovery.',
    ctaLabel: 'View Sawmill Range',
    ctaTarget: 'products',
    ctaCategory: 'Sawmills',
    imageKey: 'heroSawmill',
    partnerLabel: 'Wood-Mizer Sawmill Systems',
  },
  {
    id: 'slide-tooling',
    kicker: 'Precision Cutting & Milling Tools',
    title: 'Leitz Diamond Tooling & Circular Saw Blades',
    subtitle:
      'Tear-free FineCut blades, Diamaster PCD sizing cutters, hydro planerheads, and minifinger jointing systems built for continuous industrial output.',
    ctaLabel: 'Browse Cutting Tools',
    ctaTarget: 'products',
    ctaCategory: 'Saw Blades',
    imageKey: 'heroTooling',
    partnerLabel: 'Leitz Precision Tooling',
  },
];

export const ABOUT_CONTENT = {
  eyebrow: 'About Serendib Tools & Machineries',
  headline: "Sri Lanka's Most Trusted Machinery Partner",
  introParagraphs: [
    'Established in 2019–2020, Serendib Tools & Machineries (Pvt) Ltd. was founded with a strong commitment to support and develop the woodworking and industrial sector with high-quality machinery and reliable services. From the beginning, our goal has been to become a trusted partner for businesses by delivering world-class solutions that meet modern industry demands.',
    'We specialize in supplying world-leading brands of woodworking machinery and industrial tools, ensuring superior performance, durability, and efficiency. Our expertise goes beyond supply—we provide complete solutions, including professional installation, technical guidance, and dependable after-sales service.',
    'Our team is dedicated to understanding customer requirements and delivering tailored solutions that enhance productivity and operational efficiency. Whether it is furniture manufacturing, wood processing, or industrial applications, we strive to deliver excellence in every project we undertake.',
    'At Serendib Tools & Machineries, we believe that quality, integrity, and customer satisfaction are the foundation of long-term success. Our commitment to continuous improvement and innovation allows us to build lasting relationships with our clients and contribute to the growth of the industry.',
  ],
  vision:
    'To become the most trusted and preferred provider of woodworking machinery and industrial solutions in the region, recognized for delivering exceptional quality, innovative technologies, and outstanding customer service.',
  mission: [
    'To supply world-leading brands of woodworking machinery and industrial equipment',
    'To provide professional installation and technical expertise for all solutions.',
    'To deliver reliable and efficient after-sales service and support',
    'To offer customized solutions that meet diverse customer needs',
    'To maintain the highest standards of quality, integrity, and professionalism.',
    'To build long-term partnerships through trust, performance, and customer satisfaction',
  ],
  stats: [
    { value: '15+', label: 'Years of Trust' },
    { value: '500+', label: 'Machines Sold' },
    { value: '24/7', label: 'Technical Support' },
    { value: '100%', label: 'Island-Wide Coverage' },
  ],
  experienceSummary:
    'Serendib Tools & Machineries (Pvt) Ltd is a trusted supplier of high-quality furniture and industrial tools & machinery. We provide complete solutions including supply, installation, technical support, and after-sales service for industries across Sri Lanka. With over 15 years of experience, our certified engineers ensure every project meets the highest professional standards.',
  corePillars: [
    {
      title: 'Imported Brands',
      description: 'Global brands sourced directly from manufacturers',
    },
    {
      title: 'Expert Technicians',
      description: 'Trained and certified service engineers',
    },
    {
      title: 'Island-Wide Delivery',
      description: 'Fast delivery across all provinces',
    },
    {
      title: 'Best Pricing',
      description: 'Competitive prices with finance options',
    },
  ],
};

export const WHY_CHOOSE_US = [
  {
    id: 'genuine',
    title: 'Genuine Products Guaranteed',
    description:
      'All machinery sourced from certified international manufacturers with full warranty coverage.',
  },
  {
    id: 'installation',
    title: 'Expert Installation Team',
    description:
      'Trained technicians handle complete on-site setup, commissioning, and operator training.',
  },
  {
    id: 'aftersales',
    title: 'Comprehensive After-Sales',
    description:
      'Dedicated service team for repairs, genuine spare parts, and preventive maintenance.',
  },
  {
    id: 'payment',
    title: 'Flexible Payment Options',
    description:
      'Leasing plans, installments, and bank financing solutions for all business sizes.',
  },
];

export const SERVICES: ServiceItem[] = [
  {
    id: 'wood-log-sawing',
    number: '01',
    title: 'Wood & Log Sawing Machines',
    description:
      'Powerful and precise wood and log sawing machines, ideal for furniture manufacturing and wood processing industries of all sizes.',
    capabilities: ['Band Saws', 'Log Saws', 'Panel Saws'],
    categoryLink: 'Sliding Table Saws',
  },
  {
    id: 'furniture-industrial-tools',
    number: '02',
    title: 'Furniture & Industrial Tools Supply',
    description:
      'Reliable and durable furniture manufacturing tools and industrial machinery to improve productivity, accuracy, and efficiency.',
    capabilities: ['Hand Tools', 'Power Tools', 'Workshop'],
    categoryLink: 'Saw Blades',
  },
  {
    id: 'machinery-installation',
    number: '03',
    title: 'Machinery Installation & Technical Support',
    description:
      'Professional installation, machine setup, and on-site technical support ensuring smooth operation and long-term performance.',
    capabilities: ['On-Site Setup', 'Training', 'Support'],
    categoryLink: 'Edgebanding Machines',
  },
  {
    id: 'interior-machinery-setup',
    number: '04',
    title: 'Interior & Machinery Setup Solutions',
    description:
      'Complete interior and machinery layout solutions for workshops, factories, and production facilities of all sizes.',
    capabilities: ['Layout Design', 'Factory Setup', 'Interior'],
    categoryLink: 'All',
  },
  {
    id: 'upvc-aluminium-metal',
    number: '05',
    title: 'UPVC, Aluminium & Metal Machining',
    description:
      'Tools and machines for UPVC, aluminium, and metal machining, suitable for fabrication, cutting, drilling, and finishing.',
    capabilities: ['UPVC', 'Aluminium', 'Metal Work'],
    categoryLink: 'Profiling Tools',
  },
  {
    id: 'after-sales-maintenance',
    number: '06',
    title: 'After-Sales Service & Maintenance',
    description:
      'Dependable repair, maintenance, and servicing solutions to keep your machines running efficiently with minimal downtime.',
    capabilities: ['Repairs', 'Spare Parts', 'AMC'],
    categoryLink: 'All',
  },
];

export const PRODUCT_CATEGORIES: ProductCategory[] = [
  'Sliding Table Saws',
  'Edgebanding Machines',
  'Saw Blades',
  'Sizing Tools',
  'Planing Tools',
  'Profiling Tools',
  'Minifinger Joint Cutters',
  'Shank Tools',
  'Sawmills',
];

export const SAWMILL_SUBCATEGORIES: SawmillSubcategory[] = [
  'Portable Sawmill',
  'Industrial Sawmills',
  'Vertical Sawmills',
];

export const PRODUCTS: ProductItem[] = [
  // 1. Sliding Table Saws
  {
    id: 'altendorf-f45',
    name: 'Altendorf Sliding Table Saw F 45',
    brand: 'Altendorf',
    category: 'Sliding Table Saws',
    tagline: 'The essence of technology and design.',
    description:
      'We know how important reliable machinery is to your daily business operation. The F 45 combines iconic German engineering, torsional rigidity, and intuitive digital axis control.',
    image: '/assets/serendib/f45_hero-4.png',
    highlights: ['CNC Motorized Axes', 'German Precision Table', 'Heavy-Duty Frame'],
    featured: true,
  },
  {
    id: 'altendorf-f35',
    name: 'Altendorf Sliding Table Saw F 35',
    brand: 'Altendorf',
    category: 'Sliding Table Saws',
    description:
      'The new Altendorf F 35 is more than a sliding table saw – it is the heart of every workshop. Its solid steel body ensures stability and smooth running, built for decades of reliable woodworking.',
    image: '/assets/serendib/f35-hero-1-1200x726-1.png',
    highlights: ['Solid Steel Body', 'Smooth Running Carriage', 'Workshop Workhorse'],
  },
  {
    id: 'altendorf-f30',
    name: 'Altendorf Sliding Table Saw F 30',
    brand: 'Altendorf',
    category: 'Sliding Table Saws',
    description:
      'The new Altendorf F 30 is the professional entry into the world of sliding table saws – designed for businesses that want to combine investment security with performance.',
    image: '/assets/serendib/F-30-Typ-3-hero-cutout_new-1.png',
    highlights: ['Investment Security', 'Precision Rip Fence', 'Compact Footprint'],
  },
  {
    id: 'altendorf-f25',
    name: 'Altendorf Sliding Table Saw F 25',
    brand: 'Altendorf',
    category: 'Sliding Table Saws',
    description:
      'You can’t go wrong when you count on quality. Equipping your first workshop with original saws made by Altendorf ensures exact repeatable cuts from day one.',
    image: '/assets/serendib/f45_hero-4.png',
    highlights: ['Original Altendorf Quality', 'Entry Workshop Ready', 'Clean Mitre Cuts'],
  },
  {
    id: 'altendorf-wa6',
    name: 'Altendorf Sliding Table Saw WA 6',
    brand: 'Altendorf',
    category: 'Sliding Table Saws',
    description:
      'Everyone wants to make a good cut. Our WA 6 offers exceptional value for the money in a number of different ways with space-saving practicality.',
    image: '/assets/serendib/wa6_hero-3.png',
    highlights: ['Compact Footprint', 'Exceptional Value', 'Scoring Unit Ready'],
  },
  {
    id: 'altendorf-hand-guard',
    name: 'Altendorf HAND GUARD',
    brand: 'Altendorf',
    category: 'Sliding Table Saws',
    tagline: 'Making the best even safer.',
    description:
      'There can be no two ways about it when it comes to the highest level of safety. Early optical hand detection protects operators without interrupting production speed.',
    image: '/assets/serendib/hand-guard_hero_2022-12-1.png',
    highlights: ['AI Optical Safety', 'Instant Blade Drop', 'Zero Workpiece Damage'],
    featured: true,
  },

  // 2. Edgebanding Machines
  {
    id: 'altendorf-k37',
    name: 'ALTENDORF K 37',
    brand: 'Altendorf',
    category: 'Edgebanding Machines',
    description:
      'The K 37 boasts unparalleled power and strength. Stay lengths ahead of the competition. This high-performance power pack offers perfect edge banding with ultimate comfort and innovative features.',
    image: '/assets/serendib/K-37-hero-cut_out_US-web.png',
    highlights: ['High-Output Power Pack', 'Pre-Milling & Corner Rounding', 'Touch Control'],
    featured: true,
  },
  {
    id: 'altendorf-k36',
    name: 'ALTENDORF K 36',
    brand: 'Altendorf',
    category: 'Edgebanding Machines',
    description:
      'The ALTENDORF K 36 achieves top performance each day with flying colours. Robust, high-performance, and reliable machinery built for continuous industrial edge processing.',
    image: '/assets/serendib/K-36-hero-cut_out_US-web-1.png',
    highlights: ['Continuous Production', 'Precision Glue Application', 'Heavy Chassis'],
  },
  {
    id: 'altendorf-k34',
    name: 'ALTENDORF K 34',
    brand: 'Altendorf',
    category: 'Edgebanding Machines',
    description:
      'Even if you place the bar high, there’s still air above it. Because “good” can always be “better”, the updated K-SERIES delivers cleaner joints and faster setups.',
    image: '/assets/serendib/K-34-hero-cut_out_US-web.png',
    highlights: ['Updated K-Series', 'Fast Setup Changes', 'Zero-Joint Precision'],
  },
  {
    id: 'altendorf-f5',
    name: 'ALTENDORF F 5',
    brand: 'Altendorf',
    category: 'Edgebanding Machines',
    description:
      'The ALTENDORF F 5 produces edges to meet and exceed even the highest customer requirements. Premium craftsmanship requires perfection that our all-in-one model reliably delivers.',
    image: '/assets/serendib/Altendorf-F-5-hero-cut_out_web.png',
    highlights: ['All-In-One Edgebander', 'Multi-Profile Finishing', 'Premium Craftsmanship'],
  },
  {
    id: 'altendorf-f4',
    name: 'ALTENDORF F 4',
    brand: 'Altendorf',
    category: 'Edgebanding Machines',
    description:
      'The space-saving F 4 measures just 4 metres long. Ideal for producing fully machined edges, coming optimally equipped even in its standard version.',
    image: '/assets/serendib/Altendorf-F-4-hero-cut_out_web.png',
    highlights: ['4-Metre Footprint', 'Full Edge Machining', 'Standard Equipped'],
  },
  {
    id: 'altendorf-f2',
    name: 'ALTENDORF F 2',
    brand: 'Altendorf',
    category: 'Edgebanding Machines',
    description:
      'Premium quality really is this convincing: the F 2 is the perfect entry-level model of our powerhouse units with innovative features and compact design.',
    image: '/assets/serendib/Altendorf-F-2-hero-cut_out_web.png',
    highlights: ['Compact Design', 'Entry-Level Powerhouse', 'Low Maintenance'],
  },

  // 3. Saw Blades
  {
    id: 'leitz-accucut',
    name: 'AccuCut Circular Sawblades',
    brand: 'Leitz',
    category: 'Saw Blades',
    description:
      'Battery-powered circular saws are becoming increasingly popular. To achieve the longest possible battery lifetimes, AccuCut blades consume less energy than conventional corded blades.',
    image: '/assets/serendib/csm_AccuCut-Kreissaegeblatt_3125x1758_91a1dda405.jpg',
    highlights: ['Extended Battery Runtime', 'Low Cutting Resistance', 'Clean Finish'],
  },
  {
    id: 'leitz-thin-cut',
    name: 'Leitz Thin-Cut Circular Sawblades',
    brand: 'Leitz',
    category: 'Saw Blades',
    description:
      'In the production of thin workpieces from high quality woods, keeping the kerf as small as possible maximizes material yield. Every millimetre saved reduces raw timber cost.',
    image: '/assets/serendib/csm_Duennschnittkreissaegeblatt_3125x1758_216279574b.jpg',
    highlights: ['Ultra-Thin Kerf', 'Maximum Timber Yield', 'High Stability'],
  },
  {
    id: 'leitz-finecut',
    name: 'FineCut Circular Sawblade',
    brand: 'Leitz',
    category: 'Saw Blades',
    description:
      'The FineCut circular sawblade from Leitz opens up a completely new dimension in panel processing: it produces tear-free cutting edges even in difficult-to-machine materials – without the need for scoring.',
    image: '/assets/serendib/csm_FineCut-Kreissaegeblatt_Gruppe_3125x1758_bc8c88f1d4.jpg',
    highlights: ['Tear-Free Panel Edges', 'No Scoring Blade Needed', 'Laminate & Veneer'],
    featured: true,
  },

  // 4. Sizing Tools
  {
    id: 'leitz-diamaster-sizing',
    name: 'Leitz Diamaster PRO³ & Diamaster PLUS³',
    brand: 'Leitz',
    category: 'Sizing Tools',
    description:
      'Sizing and grooving sheet-goods with conventionally designed Z3+3 PCD tooling generally restricts productivity and quality. Diamaster PRO³ & PLUS³ overcome staggered knife limits for cleaner cuts.',
    image: '/assets/serendib/csm_Diamaster-PRO3-_-Diamaster-PLUS3_3125x1758_9dfc40f8ee.jpg',
    highlights: ['PCD Diamond Tipped', 'High Feed Speeds', 'Extended Tool Life'],
  },
  {
    id: 'leitz-hogger',
    name: 'Leitz Hogger of the New Generation',
    brand: 'Leitz',
    category: 'Sizing Tools',
    description:
      'Designed for manufacturers handling changing batch quantities and diverse carrier and decorative panel materials with clean chip evacuation and low noise levels.',
    image: '/assets/serendib/csm_DT_Premium_1_1920x1080_3902a93811.jpg',
    highlights: ['DT Premium Design', 'Quiet Operation', 'Universal Panel Use'],
  },
  {
    id: 'leitz-edgeexpert',
    name: 'Leitz Adjustable Jointing Cutter Diamaster EdgeExpert',
    brand: 'Leitz',
    category: 'Sizing Tools',
    description:
      'Innovative adjustable diamond jointing cutters from the EdgeExpert line allow unused cutting edge areas to be shifted into the quality-forming zone of covering layers.',
    image: '/assets/serendib/csm_Verstellbarer-Fuegefraeser-Diamaster-EdgeExpert_3125x1758_d660249310.jpg',
    highlights: ['Adjustable Cutting Width', 'Maximum Diamond Utilization', 'Chip-Free Edges'],
  },

  // 5. Planing Tools
  {
    id: 'leitz-turboplan-plus',
    name: 'TurboPlan PLUS Planerhead',
    brand: 'Leitz',
    category: 'Planing Tools',
    description:
      'Productivity and efficiency depend on feed rates and short set-up times. The TurboPlan PLUS hydro planerhead from Leitz fully harnesses the potential of high-performance moulders.',
    image: '/assets/serendib/csm_TurboPlan-PLUS_3125x2031_b3f4161110.jpg',
    highlights: ['Hydro Clamping', 'High Feed Rates', 'Fast Knife Change'],
  },
  {
    id: 'leitz-centroplan',
    name: 'CentroPlan Planing Cutterhead',
    brand: 'Leitz',
    category: 'Planing Tools',
    description:
      'Cost-optimized processes and perfect machining results combined in one system. With the CentroPlan planing cutterhead from Leitz, workshops achieve mirror-smooth surfaces at lower cost.',
    image: '/assets/serendib/csm_CentroPlan-Hobelmesserkopf_3125x1758_6ea9c8c3a7.jpg',
    highlights: ['Cost-Optimized', 'Precision Concentricity', 'Easy Turnblade System'],
  },
  {
    id: 'leitz-closed-hydro',
    name: 'Cutterhead with Closed Hydro Clamping System',
    brand: 'Leitz',
    category: 'Planing Tools',
    description:
      'Built for planing mills seeking production without open hydraulic clamping systems, completely preventing grease contamination on both machines and timber workpieces.',
    image: '/assets/serendib/csm_Hobel-Profilmesserkopf-mit-geschlossenem-Hydro-Spannsystem_3125x1758_0cbe2ff44c.jpg',
    highlights: ['Sealed Hydro System', 'Zero Grease Contamination', 'Constant Clamping Force'],
  },

  // 6. Profiling Tools
  {
    id: 'leitz-profilcut-q-system',
    name: 'ProfilCut Q System Group',
    brand: 'Leitz',
    category: 'Profiling Tools',
    description:
      'Engineered for window, door, and furniture manufacturers demanding higher productivity, consistent profile accuracy, and quick changeovers across production batches.',
    image: '/assets/serendib/csm_ProfilCut-Q_Link_1659x1038_3bd07db72e.jpg',
    highlights: ['Constant Profile Diameter', 'High RPM Rating', 'Fast Knife Indexing'],
  },
  {
    id: 'leitz-profilcut-q-diamond',
    name: 'ProfilCut Q Diamond',
    brand: 'Leitz',
    category: 'Profiling Tools',
    description:
      'Combines diamond-tipped edge finishing longevity with replaceable constant-diameter knife profiles so resharpening never forces time-consuming machine adjustments.',
    image: '/assets/serendib/csm_ProfilCut-Q-Diamond-Kantennnachbearbeitung_3125x1758_3e9f539412.jpg',
    highlights: ['Zero Diameter Loss', 'Resharpenable PCD', 'Edgeband Finishing'],
  },
  {
    id: 'leitz-flextrim',
    name: 'Leitz flexTrim Profile Cutters',
    brand: 'Leitz',
    category: 'Profiling Tools',
    description:
      'Ideal for furniture plants running mixed edgebanding materials and thicknesses, saving tool-change downtime while delivering flush, polished radii.',
    image: '/assets/serendib/csm_Profilfraeser-flexTrim_3125x1758_177d807d93.jpg',
    highlights: ['Multi-Radius Ready', 'ABS/PVC/Veneer', 'Reduced Setup Time'],
  },

  // 7. Minifinger Joint Cutters
  {
    id: 'leitz-minifinger-cutter',
    name: 'Leitz Minifinger Jointing Cutter',
    brand: 'Leitz',
    category: 'Minifinger Joint Cutters',
    description:
      'Coordinated tooling geometry tailored to timber species, adhesive, and machine feed to produce tight, structurally reliable finger joints every cycle.',
    image: '/assets/serendib/csm_Minizinkenfraeser_3125x1758_88eab8bc2f.jpg',
    highlights: ['Exact Joint Fit', 'High Bond Strength', 'Solid Timber Recovery'],
  },
  {
    id: 'leitz-turbohawk',
    name: 'Leitz TurboHawk Minifinger Cutterhead',
    brand: 'Leitz',
    category: 'Minifinger Joint Cutters',
    description:
      'The ideal tooling solution for flat finger-jointing lines requiring flexible profiling, high tooth count, and exceptional joint-fit precision.',
    image: '/assets/serendib/csm_TurboHawk-Minizinkenmesserkopf-Z14_3125x1758_7d5a9ec286.jpg',
    highlights: ['High Tooth Count Z14', 'Flat Line Ready', 'Precision Fit'],
  },

  // 8. Shank Tools
  {
    id: 'leitz-diamaster-shank',
    name: 'Leitz Diamaster PRO³ & Diamaster PLUS³ Router',
    brand: 'Leitz',
    category: 'Shank Tools',
    description:
      'High-efficiency CNC shank routers engineered for sizing, grooving, and nesting sheet goods with long PCD diamond service intervals.',
    image: '/assets/serendib/csm_Diamaster-PRO3-_-Diamaster-PLUS3_3125x1758_9dfc40f8ee-1.jpg',
    highlights: ['CNC Nesting Ready', 'PCD Diamond Edges', 'High Feed Rate'],
  },
  {
    id: 'leitz-helicut-monoblock',
    name: 'Leitz HeliCut Monoblock',
    brand: 'Leitz',
    category: 'Shank Tools',
    description:
      'Versatile joinery shank tool combining window cut-out milling and positioning drilling to minimize tool changes on CNC machining centres.',
    image: '/assets/serendib/csm_HeliCut-Monoblock_3125x1758_24ca70bd97.jpg',
    highlights: ['Multi-Operation Joinery', 'Fewer Tool Changes', 'Low Vibration'],
  },

  // 9. Sawmills - Portable Sawmill
  {
    id: 'woodmizer-lx30',
    name: 'LX30 Portable Sawmill',
    brand: 'Wood-Mizer',
    category: 'Sawmills',
    subcategory: 'Portable Sawmill',
    description:
      'Entry-level portable sawmill with sawyer-friendly features including a reliable 9.5HP gas engine, rev & run blade action, quick up/down head control, and quick-set log handling.',
    image: '/assets/serendib/lx30g9_2.jpg',
    highlights: ['9.5HP Gas Engine', 'Portable Steel Bed', 'Quick-Set Log Clamps'],
  },
  {
    id: 'woodmizer-lx50start',
    name: 'LX50START Portable Sawmill',
    brand: 'Wood-Mizer',
    category: 'Sawmills',
    subcategory: 'Portable Sawmill',
    description:
      'Starter portable sawmill with premium quality features including a strong steel frame, durable laser-cut steel bed, reliable 9.5HP KOHLER gas power, and convenient sawdust management.',
    image: '/assets/serendib/lx50start_gas_2.jpg',
    highlights: ['9.5HP KOHLER Power', 'Laser-Cut Steel Bed', 'Thin-Kerf Yield'],
  },
  {
    id: 'woodmizer-lx50start-trailer',
    name: 'LX50START Portable Sawmill with GO Trailer',
    brand: 'Wood-Mizer',
    category: 'Sawmills',
    subcategory: 'Portable Sawmill',
    description:
      'The LX50START portable sawmill paired with the optional GO trailer is the ultimate mobile solution for turning logs into high-quality lumber and slabs directly on site.',
    image: '/assets/serendib/lx50_start_trailer_1_2.png',
    highlights: ['Road-Towable Trailer', 'On-Site Log Milling', 'Rapid Setup'],
    featured: true,
  },

  // 9. Sawmills - Industrial Sawmills
  {
    id: 'woodmizer-wm5500',
    name: 'WM5500 Industrial Sawmill',
    brand: 'Wood-Mizer',
    category: 'Sawmills',
    subcategory: 'Industrial Sawmills',
    description:
      'High-capacity industrial wideband sawmill engineered for heavy commercial timber processing, combining automated head positioning with rugged continuous-duty hydraulics.',
    image: '/assets/serendib/wm5500_usa_render_2025.png',
    highlights: ['Industrial Wideband', 'Automated Controls', 'High-Volume Output'],
  },
  {
    id: 'woodmizer-wm2500',
    name: 'WM2500 Industrial Sawmill',
    brand: 'Wood-Mizer',
    category: 'Sawmills',
    subcategory: 'Industrial Sawmills',
    tagline: 'Break through to the next level of sawing.',
    description:
      'A high-quality, high-production sawmill designed to maximize log yield and optimize log breakdown for commercial sawmilling enterprises.',
    image: '/assets/serendib/wm2500_us_render_1920-1.png',
    highlights: ['High-Production Breakdown', 'Log Yield Optimization', 'Hydraulic Handling'],
  },
  {
    id: 'woodmizer-wm1000',
    name: 'WM1000 Wide Slab Industrial Sawmill',
    brand: 'Wood-Mizer',
    category: 'Sawmills',
    subcategory: 'Industrial Sawmills',
    description:
      'The Wood-Mizer WM1000 saws large softwood, hardwood, and tropical logs up to 67" in diameter using narrowband thin-kerf blades to deliver higher log yields than traditional large-log methods.',
    image: '/assets/serendib/wm1000me_2021_web.png',
    highlights: ['Up to 67" Log Diameter', 'Tropical Hardwood Ready', 'Thin-Kerf Recovery'],
    featured: true,
  },

  // 9. Sawmills - Vertical Sawmills
  {
    id: 'woodmizer-svs',
    name: 'Single Vertical Sawmill (SVS Vertical Resaw)',
    brand: 'Wood-Mizer',
    category: 'Sawmills',
    subcategory: 'Vertical Sawmills',
    description:
      'Placed in the line behind the TVS, the SVS (Single Vertical Saw) accurately prepares cants to move on to the resaw stage. Backed by a 2-Year Warranty.',
    image: '/assets/serendib/svsweb.png',
    highlights: ['2-Year Warranty', 'Inline Cant Prep', 'Compact Line Integration'],
  },
  {
    id: 'woodmizer-tvs',
    name: 'Reliable Twin Vertical Saw (TVS)',
    brand: 'Wood-Mizer',
    category: 'Sawmills',
    subcategory: 'Vertical Sawmills',
    description:
      'The TVS (Twin Vertical Saw) reliably removes two sides of logs, cants, and slabs simultaneously in a high-efficiency timber processing line.',
    image: '/assets/serendib/tvsweb.png',
    highlights: ['Simultaneous Dual Cut', 'Two-Sided Canting', 'High Line Speed'],
  },
  {
    id: 'woodmizer-tvshd',
    name: 'Twin Vertical Sawmill - Heavy Duty (TVSHD)',
    brand: 'Wood-Mizer',
    category: 'Sawmills',
    subcategory: 'Vertical Sawmills',
    description:
      'The TVS HD consists of a saw head with integrated waste conveyor, incline log deck, control operator cab, infeed with integrated log turner, and outfeed.',
    image: '/assets/serendib/tvshd_magento_16_9.png',
    highlights: ['Operator Control Cab', 'Integrated Log Turner', 'Waste Conveyor Included'],
  },
  {
    id: 'woodmizer-tv6000',
    name: 'TV6000 Wideband Twin Vertical Saw',
    brand: 'Wood-Mizer',
    category: 'Sawmills',
    subcategory: 'Vertical Sawmills',
    description:
      'The TV6000 is Wood-Mizer’s most robust primary breakdown twin-vertical saw that handles high throughput of small to medium diameter logs.',
    image: '/assets/serendib/tv6000web.png',
    highlights: ['Primary Breakdown Mill', 'High-Throughput Twin Band', 'Heavy Industrial Build'],
  },
];
