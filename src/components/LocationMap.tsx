import React, { useState } from 'react';
import {
  APIProvider,
  Map as GoogleMap,
  AdvancedMarker,
  Pin,
  InfoWindow,
  useAdvancedMarkerRef,
  useApiLoadingStatus,
  APILoadingStatus,
} from '@vis.gl/react-google-maps';
import { MapPin, Navigation, Phone, Clock } from 'lucide-react';
import { COMPANY_INFO } from '../data/siteData';

const SHOWROOM_POS = COMPANY_INFO.coordinates;

const ShowroomMarkerAndInfo: React.FC = () => {
  const [markerRef, marker] = useAdvancedMarkerRef();
  const [infoOpen, setInfoOpen] = useState(true);

  return (
    <>
      <AdvancedMarker
        ref={markerRef}
        position={SHOWROOM_POS}
        title={COMPANY_INFO.name}
        onClick={() => setInfoOpen((prev) => !prev)}
      >
        <Pin
          background="#1E2C7A"
          borderColor="#131D54"
          glyphColor="#F2B705"
          scale={1.25}
        />
      </AdvancedMarker>

      {infoOpen && marker && (
        <InfoWindow
          anchor={marker}
          maxWidth={270}
          onCloseClick={() => setInfoOpen(false)}
        >
          <div className="p-1 text-slate-900 space-y-1.5">
            <p className="text-sm font-bold text-[#1E2C7A]">
              {COMPANY_INFO.name}
            </p>
            <p className="text-xs text-slate-600 leading-snug">
              {COMPANY_INFO.address}
            </p>
            <a
              href={COMPANY_INFO.mapsUrl}
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center gap-1 text-xs font-semibold text-[#1E2C7A] hover:underline pt-1"
            >
              <span>Open in Google Maps</span>
            </a>
          </div>
        </InfoWindow>
      )}
    </>
  );
};

const MapFallbackCard: React.FC<{ reason?: string }> = ({ reason }) => (
  <div className="w-full h-[380px] sm:h-[420px] rounded-2xl border border-slate-200 bg-slate-100 flex flex-col items-center justify-center p-6 text-center">
    <div className="w-12 h-12 rounded-xl bg-[#1E2C7A] text-[#F2B705] flex items-center justify-center mb-4">
      <MapPin className="w-6 h-6" aria-hidden="true" />
    </div>
    <h3 className="text-lg font-bold text-slate-900 mb-1">
      Serendib Tools — Kesbawa Showroom
    </h3>
    <p className="text-sm text-slate-600 max-w-md mb-2">
      {COMPANY_INFO.address}
    </p>
    {reason && <p className="text-xs text-slate-500 mb-4">{reason}</p>}
    <div className="flex flex-wrap items-center justify-center gap-3 mt-2">
      <a
        href={COMPANY_INFO.mapsUrl}
        target="_blank"
        rel="noopener noreferrer"
        className="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-[#1E2C7A] hover:bg-[#131D54] rounded-lg transition-colors"
      >
        <Navigation className="w-4 h-4 text-[#F2B705]" aria-hidden="true" />
        <span>Get Directions on Google Maps</span>
      </a>
      <a
        href={COMPANY_INFO.phoneHref}
        className="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-300 hover:border-[#1E2C7A] rounded-lg transition-colors tabular-nums"
      >
        <Phone className="w-4 h-4 text-[#1E2C7A]" aria-hidden="true" />
        <span>{COMPANY_INFO.phoneCompact}</span>
      </a>
    </div>
  </div>
);

const InnerGoogleMap: React.FC = () => {
  const status = useApiLoadingStatus();

  if (
    status === APILoadingStatus.FAILED ||
    status === APILoadingStatus.AUTH_FAILURE
  ) {
    return (
      <MapFallbackCard reason="Interactive map temporarily unavailable. Use direct Google Maps directions below." />
    );
  }

  return (
    <div className="relative w-full h-[380px] sm:h-[420px] rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
      <GoogleMap
        mapId="DEMO_MAP_ID"
        defaultCenter={SHOWROOM_POS}
        defaultZoom={15}
        gestureHandling="cooperative"
        internalUsageAttributionIds={['gmp_mcp_codeassist_v1_aistudio']}
        style={{ width: '100%', height: '100%' }}
      >
        <ShowroomMarkerAndInfo />
      </GoogleMap>
    </div>
  );
};

export const LocationMap: React.FC = () => {
  const apiKey = import.meta.env.VITE_GOOGLE_MAPS_API_KEY as string | undefined;

  return (
    <div className="space-y-4">
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
          <p className="text-xs font-semibold uppercase tracking-wider text-[#1E2C7A]">
            Showroom &amp; Service Center Location
          </p>
          <h3 className="text-xl sm:text-2xl font-bold text-slate-900">
            Visit Us in Kesbawa, Sri Lanka
          </h3>
        </div>
        <a
          href={COMPANY_INFO.mapsUrl}
          target="_blank"
          rel="noopener noreferrer"
          className="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-[#1E2C7A] bg-slate-100 hover:bg-[#1E2C7A] hover:text-white rounded-lg transition-colors self-start sm:self-auto"
        >
          <Navigation className="w-3.5 h-3.5" aria-hidden="true" />
          <span>Get Directions</span>
        </a>
      </div>

      {apiKey ? (
        <APIProvider
          apiKey={apiKey}
          libraries={['marker']}
          language="en"
          region="LK"
        >
          <InnerGoogleMap />
        </APIProvider>
      ) : (
        <MapFallbackCard />
      )}

      <div className="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs text-slate-600 bg-slate-50 border border-slate-200 rounded-xl p-4">
        <div className="flex items-start gap-2">
          <MapPin className="w-4 h-4 text-[#1E2C7A] shrink-0 mt-0.5" aria-hidden="true" />
          <span>{COMPANY_INFO.address}</span>
        </div>
        <div className="flex items-start gap-2">
          <Clock className="w-4 h-4 text-[#1E2C7A] shrink-0 mt-0.5" aria-hidden="true" />
          <span>{COMPANY_INFO.hours}</span>
        </div>
      </div>
    </div>
  );
};
