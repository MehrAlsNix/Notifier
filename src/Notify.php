<?php
/**
 * Notifier
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @copyright 2015 MehrAlsNix (http://www.mehralsnix.de)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://github.com/MehrAlsNix/Notifier
 */

namespace MehrAlsNix\Notifier;

/**
 * Class Notify
 * @package MehrAlsNix\Notifier
 */
class Notify
{
    /** @var Notification $instance */
    private static $instance;

    /**
     * Get instance.
     *
     * @throws \RuntimeException
     */
    public static function getInstance()
    {
        if (!self::$instance instanceof Notification) {
            self::$instance = self::fetch();
        }
    }

    /**
     * Fetches an instance by checking for ability.
     *
     * @return Commands\Linux|Commands\Mac|Commands\Windows
     *
     * @throws \RuntimeException
     */
    protected function fetch()
    {
        $instance = (new Commands\Windows())->isAvailable() ? new Commands\Windows()
            : (new Commands\Linux())->isAvailable() ? new Commands\Linux()
                : (new Commands\Mac())->isAvailable() ? new Commands\Mac()
                    : 'No valid desktop notifier found.';

        if (is_string($instance)) {
            throw new \RuntimeException($instance);
        }

        return $instance;
    }
}
