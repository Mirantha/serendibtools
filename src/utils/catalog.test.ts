import test from 'node:test';
import assert from 'node:assert/strict';
import { PRODUCTS, SERVICES, COMPANY_INFO } from '../data/siteData';
import {
  filterProducts,
  searchCatalog,
  validateQuoteForm,
  buildWhatsAppUrl,
} from './catalog';

test('filterProducts filters by category and sawmill subcategory', () => {
  const saws = filterProducts(PRODUCTS, { category: 'Sliding Table Saws' });
  assert.equal(saws.length, 6);
  assert.ok(saws.every((p) => p.category === 'Sliding Table Saws'));

  const verticalSawmills = filterProducts(PRODUCTS, {
    category: 'Sawmills',
    subcategory: 'Vertical Sawmills',
  });
  assert.equal(verticalSawmills.length, 4);
  assert.ok(verticalSawmills.every((p) => p.subcategory === 'Vertical Sawmills'));
});

test('filterProducts matches case-insensitive search queries across brand, title, and description', () => {
  const altendorf = filterProducts(PRODUCTS, { query: 'altendorf' });
  assert.equal(altendorf.length, 12);

  const finecut = filterProducts(PRODUCTS, { query: 'tear-free' });
  assert.equal(finecut.length, 1);
  assert.equal(finecut[0].id, 'leitz-finecut');
});

test('searchCatalog finds both matching products and services', () => {
  const empty = searchCatalog(PRODUCTS, SERVICES, '   ');
  assert.equal(empty.products.length, 0);
  assert.equal(empty.services.length, 0);

  const res = searchCatalog(PRODUCTS, SERVICES, 'installation');
  assert.ok(res.services.some((s) => s.id === 'machinery-installation'));

  const sawmillRes = searchCatalog(PRODUCTS, SERVICES, 'Wood-Mizer');
  assert.equal(sawmillRes.products.length, 10);
});

test('validateQuoteForm catches missing required fields and invalid email', () => {
  const invalid = validateQuoteForm({
    fullName: '',
    phone: '123',
    email: 'bad-email',
    serviceRequired: '',
    message: '',
  });
  assert.ok(invalid.fullName);
  assert.ok(invalid.phone);
  assert.ok(invalid.email);
  assert.ok(invalid.serviceRequired);

  const valid = validateQuoteForm({
    fullName: 'Kasun Perera',
    phone: '+94 77 731 6002',
    email: 'kasun@workshop.lk',
    serviceRequired: 'Wood & Log Sawing Machines',
    message: 'Need pricing for Altendorf F 45',
  });
  assert.deepEqual(valid, {});
});

test('buildWhatsAppUrl encodes message cleanly for Serendib WhatsApp number', () => {
  const url = buildWhatsAppUrl(
    COMPANY_INFO.whatsappNumber,
    'Hello Serendib Tools, I want a quote for Altendorf F 45.'
  );
  assert.ok(url.startsWith('https://wa.me/94777316002?text='));
  assert.ok(url.includes('Altendorf%20F%2045'));
});
