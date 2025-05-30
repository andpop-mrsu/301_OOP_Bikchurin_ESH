import createFraction from '../src/createFraction.js';

describe('createFraction', () => {
  test('create snd normalize', () => {
    const fraction = new createFraction(4, 8);
    expect(fraction.numer).toBe(1);
    expect(fraction.denom).toBe(2);
  });

  test('add()', () => {
    const fraction1 = new createFraction(1, 4);
    const fraction2 = new createFraction(1, 3);
    const result = fraction1.add(fraction2);
    expect(result.numer).toBe(7);
    expect(result.denom).toBe(12);
  });

  test('sub()', () => {
    const fraction1 = new createFraction(1, 5);
    const fraction2 = new createFraction(3, 5);
    const result = fraction1.sub(fraction2);
    expect(result.numer).toBe(-2);
    expect(result.denom).toBe(5);
  });

  test('toString()', () => {
    const fraction1 = new createFraction(3, 2);
    expect(fraction1.toString()).toBe('1\'1/2');

    const fraction2 = new createFraction(-5, 2);
    expect(fraction2.toString()).toBe('-2\'1/2');

    const fraction3 = new createFraction(0, 7);
    expect(fraction3.toString()).toBe('0');
  });
});