import React from 'react';
import {
  Globe,
  HardHat,
  Truck,
  BadgeDollarSign,
  CheckCircle2,
  ArrowRight,
} from 'lucide-react';
import { ABOUT_CONTENT, type PageRoute } from '../data/siteData';
import { MEDIA_ASSETS } from '../data/mediaAssets';
import { PageHeader } from '../components/PageHeader';
import { TrustBar, WhySerendibSection } from '../components/WhySerendibSection';

interface AboutPageProps {
  onNavigate: (page: PageRoute) => void;
}

const PILLAR_ICONS = [Globe, HardHat, Truck, BadgeDollarSign];

export const AboutPage: React.FC<AboutPageProps> = ({ onNavigate }) => {
  return (
    <div>
      <PageHeader
        title="About Us"
        eyebrow="Serendib Tools & Machineries (Pvt) Ltd."
        subtitle="Supporting Sri Lanka's woodworking, furniture manufacturing, and industrial sectors with world-leading machinery and certified after-sales care since 2019–2020."
        imageSrc={MEDIA_ASSETS.bannerAboutFactory}
        imageAlt="Serendib Tools engineers calibrating precision woodworking machinery"
        onNavigateHome={() => onNavigate('home')}
        currentLabel="About"
      />

      <TrustBar />

      {/* Company Overview */}
      <section className="py-16 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div className="lg:col-span-7 space-y-5">
              <p className="text-xs font-semibold uppercase tracking-wider text-[#1E2C7A]">
                Established {ABOUT_CONTENT.stats[0] ? '2019–2020' : ''}
              </p>
              <h2 className="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight text-balance">
                {ABOUT_CONTENT.headline}
              </h2>
              <div className="space-y-4 text-sm sm:text-base text-slate-600 leading-relaxed">
                {ABOUT_CONTENT.introParagraphs.map((para, idx) => (
                  <p key={idx}>{para}</p>
                ))}
              </div>
            </div>

            <div className="lg:col-span-5 space-y-6">
              <div className="rounded-2xl overflow-hidden border border-slate-200 bg-slate-100">
                <img
                  src={MEDIA_ASSETS.aboutVision}
                  alt="Serendib Tools global machinery partnership and engineering"
                  referrerPolicy="no-referrer"
                  className="w-full h-64 sm:h-72 object-cover"
                />
              </div>

              <div className="grid grid-cols-2 gap-4">
                {ABOUT_CONTENT.stats.map((stat) => (
                  <div
                    key={stat.label}
                    className="p-5 rounded-xl bg-[#131D54] text-white"
                  >
                    <p className="text-2xl sm:text-3xl font-bold text-[#F2B705] tabular-nums">
                      {stat.value}
                    </p>
                    <p className="text-xs sm:text-sm font-medium text-slate-200 mt-1">
                      {stat.label}
                    </p>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Vision & Mission */}
      <section className="py-16 bg-slate-50 border-y border-slate-200">
        <div className="max-w-7xl mx-auto px-4 sm:px-6">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 items-stretch">
            <div className="lg:col-span-5">
              <div className="h-full min-h-[300px] rounded-2xl overflow-hidden border border-slate-200 bg-white">
                <img
                  src={MEDIA_ASSETS.aboutMission}
                  alt="Serendib Tools partnership, installation, and logistics"
                  referrerPolicy="no-referrer"
                  className="w-full h-full object-cover"
                />
              </div>
            </div>

            <div className="lg:col-span-7 flex flex-col justify-center space-y-8">
              <div className="bg-white border border-slate-200 rounded-xl p-6 sm:p-8">
                <p className="text-xs font-semibold uppercase tracking-wider text-[#1E2C7A] mb-2">
                  Our Vision
                </p>
                <p className="text-base sm:text-lg font-medium text-slate-800 leading-relaxed">
                  {ABOUT_CONTENT.vision}
                </p>
              </div>

              <div className="bg-white border border-slate-200 rounded-xl p-6 sm:p-8">
                <p className="text-xs font-semibold uppercase tracking-wider text-[#1E2C7A] mb-4">
                  Our Mission
                </p>
                <ul className="space-y-3">
                  {ABOUT_CONTENT.mission.map((item) => (
                    <li
                      key={item}
                      className="flex items-start gap-3 text-sm sm:text-base text-slate-700"
                    >
                      <CheckCircle2
                        className="w-5 h-5 text-[#1E2C7A] shrink-0 mt-0.5"
                        aria-hidden="true"
                      />
                      <span>{item}</span>
                    </li>
                  ))}
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Experience & Core Pillars */}
      <section className="py-16 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6">
          <div className="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div className="max-w-2xl">
              <p className="text-xs font-semibold uppercase tracking-wider text-[#1E2C7A] mb-2">
                Our Capabilities
              </p>
              <h2 className="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-3">
                Complete Solutions Across Sri Lanka
              </h2>
              <p className="text-sm sm:text-base text-slate-600 leading-relaxed">
                {ABOUT_CONTENT.experienceSummary}
              </p>
            </div>
            <button
              type="button"
              onClick={() => onNavigate('contact')}
              className="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-[#131D54] bg-[#F2B705] hover:bg-[#D69E00] rounded-lg transition-colors cursor-pointer whitespace-nowrap self-start md:self-auto"
            >
              <span>Speak With an Engineer</span>
              <ArrowRight className="w-4 h-4" aria-hidden="true" />
            </button>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {ABOUT_CONTENT.corePillars.map((pillar, idx) => {
              const Icon = PILLAR_ICONS[idx % PILLAR_ICONS.length];
              return (
                <div
                  key={pillar.title}
                  className="p-6 rounded-xl bg-slate-50 border border-slate-200"
                >
                  <div className="w-10 h-10 rounded-lg bg-[#1E2C7A]/10 text-[#1E2C7A] flex items-center justify-center mb-4">
                    <Icon className="w-5 h-5" aria-hidden="true" />
                  </div>
                  <h3 className="text-base font-bold text-slate-900 mb-1.5">
                    {pillar.title}
                  </h3>
                  <p className="text-sm text-slate-600">{pillar.description}</p>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      <WhySerendibSection />
    </div>
  );
};
