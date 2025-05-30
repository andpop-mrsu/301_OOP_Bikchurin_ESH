import createFraction from '../src/createFraction.js';

describe('createFraction', () => {
  test('getNumer() и getDenom()', () => {
    const fraction = new createFraction(4, 8);
    expect(fraction.getNumer()).toBe(1);
    expect(fraction.getDenom()).toBe(2);
  });

  test('add()', () => {
    const fraction1 = new createFraction(1, 4);
    const fraction2 = new createFraction(1, 3);
    const result = fraction1.add(fraction2);
    expect(result.getNumer()).toBe(7);
    expect(result.getDenom()).toBe(12);
  });

  test('sub()', () => {
    const fraction1 = new createFraction(1, 2);
    const fraction2 = new createFraction(3, 4);
    const result = fraction1.sub(fraction2);
    expect(result.getNumer()).toBe(-1);
    expect(result.getDenom()).toBe(4);
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